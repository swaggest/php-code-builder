<?php

namespace Swaggest\PhpCodeBuilder\JSDoc;

use Swaggest\CodeBuilder\CodeBuilder;
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

    /**
     * @param Schema|boolean $schema
     * @param string $path
     * @return string
     */
    public function getTypeString($schema, $path = '')
    {
        $schema = Schema::unboolSchema($schema);

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

        if ($schema->oneOf !== null) {
            foreach ($schema->oneOf as $item) {
                $or[] = $this->getTypeString($item);
            }
        }

        if ($schema->anyOf !== null) {
            foreach ($schema->anyOf as $item) {
                $or[] = $this->getTypeString($item);
            }
        }

        if ($schema->allOf !== null) {
            foreach ($schema->allOf as $item) {
                $or[] = $this->getTypeString($item);
            }
        }

        if ($schema->then !== null) {
            $or[] = $this->getTypeString($schema->then);
        }

        if ($schema->else !== null) {
            $or[] = $this->getTypeString($schema->else);
        }

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
                    if ($schema instanceof Schema) {
                        $typeName = $this->typeName($schema, $path);
                        $this->makeObjectTypeDef($schema, $path);

                        $or [] = $typeName;
                        $typeAdded = true;
                    }
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
                        $typeName = $this->getTypeString($propertySchema, $path . '/patternProperties/' . $pattern);
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

        $res = '';
        foreach ($or as $item) {
            if (!empty($item) && $item !== '*') {
                $res .= '|' . $item;
            }
        }

        if ($res !== '') {
            $res = substr($res, 1);
        } else {
            $res = '*';
        }

        return $res;
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

        $head = '';
        if (!empty($schema->title)) {
            $head .= $schema->title . "\n";
        }

        if (!empty($schema->description)) {
            $head .= $schema->description . "\n";
        }

        if ($head !== '') {
            $head = "\n" . CodeBuilder::padLines(' * ', trim($head), false);
        }

        $res = <<<JSDOC
/**$head
 * @typedef {$typeName}
 * @type {object}

JSDOC;
        if (!empty($schema->properties)) {
            foreach ($schema->properties as $propertyName => $propertySchema) {
                $typeString = $this->getTypeString($propertySchema, $path . '/' . $propertyName);
                $res .= <<<JSDOC
 * @property {{$typeString}} {$propertyName}{$this->description($propertySchema)}.

JSDOC;

            }
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