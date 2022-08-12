<?php

namespace Swaggest\PhpCodeBuilder\Markdown;

use Swaggest\CodeBuilder\CodeBuilder;
use Swaggest\CodeBuilder\TableRenderer;
use Swaggest\JsonSchema\Schema;
use Swaggest\PhpCodeBuilder\PhpCode;

class TypeBuilder
{
    const EXAMPLES = 'examples';
    const EXAMPLE = 'example';

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
     * @param Schema|boolean|null $schema
     * @param string $path
     * @return string
     */
    public function getTypeString($schema, $path = '')
    {
        if ($schema === null) {
            return '';
        }

        $schema = Schema::unboolSchema($schema);

        $isOptional = false;
        $isObject = false;
        $isArray = false;
        $isBoolean = false;
        $isString = false;
        $isNumber = false;

        if ($schema->const !== null) {
            return '`' . var_export($schema->const, true) . '`';
        }

        if (!empty($schema->enum)) {
            $res = '';
            foreach ($schema->enum as $value) {
                $res .= '<br>`' . var_export($value, true) . '`, ';
            }
            return substr($res, 4, -2);
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


        $namedTypeAdded = false;
        if (!empty($schema->properties) || $this->hasConstraints($schema)) {
            if ($this->processed->contains($schema)) {
                $or [] = $this->processed->offsetGet($schema);
                $namedTypeAdded = true;
            } else {
                if ($schema instanceof Schema) {
                    $typeName = $this->typeName($schema, $path);
                    $this->makeTypeDef($schema, $path);

                    $or [] = $typeName;
                    $namedTypeAdded = true;
                }
            }
        }

        if ($isObject) {
            $typeAdded = false;

            if ($namedTypeAdded) {
                $typeAdded = true;
            }

            if ($schema->additionalProperties instanceof Schema) {
                $typeName = $this->getTypeString($schema->additionalProperties, $path . '/additionalProperties');
                $or [] = "`Map<String,`$typeName`>`";
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
                $or [] = '`Object`';
            }
        }

        if ($isArray) {
            $typeAdded = false;

            if ($schema->items instanceof Schema) {
                $typeName = $this->getTypeString($schema->items, $path . '/items');
                $or [] = "`Array<`$typeName`>`";
                $typeAdded = true;
            }

            if ($schema->additionalItems instanceof Schema) {
                $typeName = $this->getTypeString($schema->additionalItems, $path . '/additionalItems');
                $or [] = "`Array<`$typeName`>`";
                $typeAdded = true;
            }

            if (!$typeAdded) {
                $or [] = '`Array`';
            }
        }

        if ($isOptional) {
            $or [] = '`null`';
        }

        if ($isString) {
            $or [] = '`String`';
        }

        if ($isNumber) {
            $or [] = '`Number`';
        }

        if ($isBoolean) {
            $or [] = '`Boolean`';
        }

        if ($schema->format !== null) {
            $or []= 'Format: `' . $schema->format . '`';
        }

        $res = '';
        foreach ($or as $item) {
            if (!empty($item) && $item !== '*') {
                $res .= ', ' . $item;
            }
        }

        if ($res !== '') {
            $res = substr($res, 2);
        } else {
            $res = '`*`';
        }

        $res = str_replace('``', '', $res);

        return $res;
    }

    private function typeName(Schema $schema, $path, $raw = false)
    {
        if ($fromRefs = $schema->getFromRefs()) {
            $path = $fromRefs[count($fromRefs) - 1];
        }

        foreach ($this->trimNamePrefix as $prefix) {
            if ($prefix === substr($path, 0, strlen($prefix))) {
                $path = substr($path, strlen($prefix));
            }
        }

        if (($path === '#' || empty($path)) && !empty($schema->title)) {
            $path = $schema->title;
        }

        $name = PhpCode::makePhpName($this->addNamePrefix . '_' . $path, false);

        if ($raw) {
            return $name;
        }

        return '[`' . $name . '`](#' . strtolower($name) . ')';
    }

    private static function constraints()
    {
        static $constraints;

        if ($constraints === null) {
            $names = Schema::names();
            $constraints = [
                $names->multipleOf,
                $names->maximum,
                $names->exclusiveMaximum,
                $names->minimum,
                $names->exclusiveMinimum,
                $names->maxLength,
                $names->minLength,
                $names->pattern,
                $names->maxItems,
                $names->minItems,
                $names->uniqueItems,
                $names->maxProperties,
                $names->minProperties,
            ];
        }

        return $constraints;
    }

    /**
     * @param Schema $schema
     */
    private function hasConstraints($schema)
    {
        foreach (self::constraints() as $name) {
            if ($schema->$name !== null) {
                return true;
            }
        }

        return false;
    }

    private function makeTypeDef(Schema $schema, $path)
    {
        $tn = $this->typeName($schema, $path, true);
        $typeName = $this->typeName($schema, $path);
        $this->processed->attach($schema, $typeName);

        $head = '';
        if (!empty($schema->title) && $schema->title != $tn) {
            $head .= $schema->title . "\n";
        }

        if (!empty($schema->description)) {
            $head .= $schema->description . "\n";
        }

        $examples = [];
        if (!empty($schema->{self::EXAMPLES})) {
            $examples = $schema->{self::EXAMPLES};
        }

        if (!empty($schema->{self::EXAMPLE})) {
            $examples[] = $schema->{self::EXAMPLE};
        }

        if (!empty($examples)) {
            $head .= "Example:\n\n";
            foreach ($examples as $example) {
                $head .= <<<MD
```json
$example
```


MD;

            }
        }

        $tnl = strtolower($tn);

        $res = <<<MD


### <a id="$tnl"></a>$tn
$head

MD;


        $rows = [];
        foreach (self::constraints() as $name) {
            if ($schema->$name !== null) {
                $value = $schema->$name;

                if ($value instanceof Schema) {
                    $value = $this->typeName($value, $path . '/' . $name);
                }

                $rows [] = [
                    'Constraint' => $name,
                    'Value' => $value,
                ];
            }
        }
        $res .= TableRenderer::create(new \ArrayIterator($rows))
            ->stripEmptyColumns()
            ->setColDelimiter('|')
            ->setHeadRowDelimiter('-')
            ->setOutlineVertical(true)
            ->setShowHeader();

        $res .= "\n\n";

        $rows = [];
        $hasDescription = false;
        if (!empty($schema->properties)) {
            foreach ($schema->properties as $propertyName => $propertySchema) {
                $typeString = $this->getTypeString($propertySchema, $path . '/' . $propertyName);
                $desc = $this->description($propertySchema);
                if (!empty($desc)) {
                    $hasDescription = true;
                }
                $isRequired = false;
                if (!empty($schema->required)) {
                    $isRequired = in_array($propertyName, $schema->required);
                }
                $rows [] = array(
                    'Property' => '`' . $propertyName . '`' . ($isRequired ? ' (required)' : ''),
                    'Type' => $typeString,
                    'Description' => $desc,
                );
            }

            if (!$hasDescription) {
                foreach ($rows as &$row) {
                    unset($row['Description']);
                }
            }

            $res .= TableRenderer::create(new \ArrayIterator($rows))
                ->stripEmptyColumns()
                ->setColDelimiter('|')
                ->setHeadRowDelimiter('-')
                ->setOutlineVertical(true)
                ->setShowHeader();

        }

        $res .= <<<MD

MD;

        $this->file .= $res;

        return $typeName;
    }

    private function description(Schema $schema)
    {
        $res = str_replace("\n", " ", $schema->title . $schema->description);
        if ($res) {
            return rtrim($res, '.') . '.';
        }

        return '';
    }
}