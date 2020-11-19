<?php

namespace Swaggest\PhpCodeBuilder\JSDoc;

use Swaggest\JsonSchema\Schema;
use Swaggest\PhpCodeBuilder\PhpCode;

class TypeBuilder
{
    /** @var \SplObjectStorage */
    private $processed;

    public $trimNamePrefix = [
        '#/definitions'
    ];

    public $file = '';

    public function __construct()
    {
        $this->processed = new \SplObjectStorage();
    }

    public function getTypeString(Schema $schema, $path = '')
    {
        $isOptional = false;
        $isObject = false;
        $isArray = false;
        $isBoolean = false;
        $isString = false;
        $isNumber = false;

        $type = $schema->type;
        if (!is_array($type)) {
            $type = [$type];
        }

        $or = [];

        foreach ($type as $i => $t) {
            switch ($t) {
                case Schema::NULL:
                    $isOptional = true;
                    break;

                case Schema::OBJECT:
                    $isObject = true;
                    break;

                case Schema::_ARRAY:
                    $isArray = true;
                    break;

                case Schema::NUMBER:
                case Schema::INTEGER:
                    $isNumber = true;
                    break;

                case Schema::STRING:
                    $isString = true;
                    break;

                case Schema::BOOLEAN:
                    $isBoolean = true;
                    break;

            }
        }

        if ($isObject) {
            $typeAdded = false;

            if (!empty($schema->properties)) {
                if ($this->processed->contains($schema)) {
                    $or [] = $this->processed->offsetGet($schema);
                    $typeAdded = true;
                } else {
                    $typeName = $this->typeName($schema, $path);
                    $this->makeObjectTypeDef($schema, $path);

                    $or [] = $typeName;
                    $typeAdded = true;
                }

            }

            if ($schema->additionalProperties instanceof Schema) {
                $typeName = $this->getTypeString($schema->additionalProperties, $path . '/additionalProperties');
                $or [] = "object<string, $typeName>";
                $typeAdded = true;
            }

            if (!empty($schema->patternProperties)) {
                foreach ($schema->patternProperties as $pattern => $propertySchema) {
                    if ($propertySchema instanceof Schema) {
                        $typeName = $this->getTypeString($schema->additionalProperties, $path . '/patternProperties/' . $pattern);
                        $or [] = $typeName;
                        $typeAdded = true;
                    }
                }
            }

            if (!$typeAdded) {
                $or [] = 'object';
            }
        }

        if ($isArray) {
            $typeAdded = false;

            if ($schema->items instanceof Schema) {
                $typeName = $this->getTypeString($schema->items, $path . '/items');
                $or [] = "array<$typeName>";
                $typeAdded = true;
            }

            if ($schema->additionalItems instanceof Schema) {
                $typeName = $this->getTypeString($schema->additionalItems, $path . '/additionalItems');
                $or [] = "array<$typeName>";
                $typeAdded = true;
            }

            if (!$typeAdded) {
                $or [] = 'array';
            }
        }

        if ($isString) {
            $or [] = 'string';
        }

        if ($isNumber) {
            $or [] = 'number';
        }

        if ($isBoolean) {
            $or [] = 'boolean';
        }

        return join('|', $or);
    }

    private function typeName(Schema $schema, $path)
    {
        if ($fromRefs = $schema->getFromRefs()) {
            $path = $fromRefs[count($fromRefs) - 1];
        }

        foreach ($this->trimNamePrefix as $prefix) {
            if ($prefix === substr($path, 0, strlen($prefix))) {
                $path = substr($path, strlen($prefix));
            }
        }

        return PhpCode::makePhpName($path, false);
    }

    private function makeObjectTypeDef(Schema $schema, $path)
    {
        $typeName = $this->typeName($schema, $path);
        $this->processed->attach($schema, $typeName);

        $res = <<<JSDOC
/**
 * @typedef {$typeName}
 * @type {object}

JSDOC;
        foreach ($schema->properties as $propertyName => $propertySchema) {
            $typeString = $this->getTypeString($propertySchema, $path . '/' . $propertyName);
            $res .= <<<JSDOC
 * @property {{$typeString}} {$propertyName}{$this->description($propertySchema)}.

JSDOC;

        }

        $res .= <<<JSDOC
 */

JSDOC;

        $this->file .= $res;

        return $typeName;
    }

    private function description(Schema $schema)
    {
        $res = str_replace("\n", " ", $schema->title . $schema->description);
        if ($res) {
            return ' - ' . rtrim($res, '.');
        }

        return '';
    }
}