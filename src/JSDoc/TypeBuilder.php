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

    public $addNamePrefix = '';

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

        if ($schema->const !== null) {
            return '(' . var_export($schema->const, true) . ')';
        }

        if (!empty($schema->enum)) {
            $res = '';
            foreach ($schema->enum as $value) {
                $res .= var_export($value, true) . '|';
            }
            return '(' . substr($res, 0, -1) . ')';
        }

        if (!empty($schema->getFromRefs())) {
            $refs = $schema->getFromRefs();
            $path = $refs[0];
        }

        $type = $schema->type;
        if ($type === null) {
            $type = [];

            if (!empty($schema->properties) || !empty($schema->additionalProperties) || !empty($schema->patternProperties)) {
                $type[] = Schema::OBJECT;
            }

            if (!empty($schema->items) || !empty($schema->additionalItems)) {
                $type[] = Schema::_ARRAY;
            }
        }

        if (!is_array($type)) {
            $type = [$type];
        }

        $or = [];

        if ($schema->oneOf !== null) {
            foreach ($schema->oneOf as $i => $item) {
                $or[] = $this->getTypeString($item, $path . '/oneOf/' . $i);
            }
        }

        if ($schema->anyOf !== null) {
            foreach ($schema->anyOf as $i => $item) {
                $or[] = $this->getTypeString($item, $path . '/anyOf/' . $i);
            }
        }

        if ($schema->allOf !== null) {
            foreach ($schema->allOf as $i => $item) {
                $or[] = $this->getTypeString($item, $path . '/allOf/' . $i);
            }
        }

        if ($schema->then !== null) {
            $or[] = $this->getTypeString($schema->then, $path . '/then');
        }

        if ($schema->else !== null) {
            $or[] = $this->getTypeString($schema->else, $path . '/else');
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
                $or [] = "Object.<String,$typeName>";
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
                $or [] = 'Object';
            }
        }

        if ($isArray) {
            $typeAdded = false;

            if ($schema->items instanceof Schema) {
                $typeName = $this->getTypeString($schema->items, $path . '/items');
                $or [] = "Array<$typeName>";
                $typeAdded = true;
            }

            if ($schema->additionalItems instanceof Schema) {
                $typeName = $this->getTypeString($schema->additionalItems, $path . '/additionalItems');
                $or [] = "Array<$typeName>";
                $typeAdded = true;
            }

            if (!$typeAdded) {
                $or [] = 'Array';
            }
        }

        if ($isString) {
            if ($schema->format === 'binary') {
                $or[] = 'File';
                $or[] = 'Blob';
            } else {
                $or[] = 'String';
            }
        }

        if ($isNumber) {
            $or [] = 'Number';
        }

        if ($isBoolean) {
            $or [] = 'Boolean';
        }

        $res = '';
        foreach ($or as $item) {
            if (!empty($item) && $item !== '*') {
                $res .= '|' . ($isOptional ? '?' : '') . $item;
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

        return PhpCode::makePhpName($this->addNamePrefix . '_' . $path, false);
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
 * @type {Object}

JSDOC;
        if (!empty($schema->properties)) {
            foreach ($schema->properties as $propertyName => $propertySchema) {
                $typeString = $this->getTypeString($propertySchema, $path . '/' . $propertyName);
                $res .= <<<JSDOC
 * @property {{$typeString}} {$propertyName}{$this->description($propertySchema)}

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
        $res = str_replace("\n", " ", trim($schema->title));
        if (trim($schema->description)) {
            if ($res) {
                $res .= ". ";
            }

            $res .= str_replace("\n", " ", trim($schema->description));
        }
        if ($res) {
            return ' - ' . rtrim($res, '.') . '.';
        }

        return '';
    }
}