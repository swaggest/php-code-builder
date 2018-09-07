<?php

namespace Swaggest\PhpCodeBuilder\JsonSchema;


use Swaggest\CodeBuilder\PlaceholderString;
use Swaggest\JsonSchema\Constraint\Type;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\Structure\ClassStructure;
use Swaggest\JsonSchema\Structure\ObjectItem;
use Swaggest\PhpCodeBuilder\PhpClass;
use Swaggest\PhpCodeBuilder\PhpCode;
use Swaggest\PhpCodeBuilder\PhpConstant;
use Swaggest\PhpCodeBuilder\Types\ReferenceTypeOf;
use Swaggest\PhpCodeBuilder\Types\TypeOf;

class SchemaBuilder
{
    /** @var Schema */
    private $schema;
    /** @var string */
    private $varName;
    /** @var bool */
    private $createVarName;

    /** @var PhpBuilder */
    private $phpBuilder;
    /** @var string */
    private $path;

    /** @var PhpCode */
    private $result;

    /** @var bool */
    private $skipProperties;

    /** @var PhpClass */
    private $saveEnumConstInClass;

    /**
     * SchemaBuilder constructor.
     * @param Schema $schema
     * @param string $varName
     * @param string $path
     * @param PhpBuilder $phpBuilder
     * @param bool $createVarName
     */
    public function __construct($schema, $varName, $path, PhpBuilder $phpBuilder, $createVarName = true)
    {
        $this->schema = $schema;
        $this->varName = $varName;
        $this->phpBuilder = $phpBuilder;
        $this->path = $path;
        $this->createVarName = $createVarName;
    }

    private function processType()
    {
        if ($this->schema->type !== null) {
            switch ($this->schema->type) {
                case Type::INTEGER:
                    $result = $this->createVarName
                        ? "{$this->varName} = ::schema::integer();"
                        : "{$this->varName}->type = ::schema::INTEGER;";
                    break;

                case Type::NUMBER:
                    $result = $this->createVarName
                        ? "{$this->varName} = ::schema::number();"
                        : "{$this->varName}->type = ::schema::NUMBER;";
                    break;

                case Type::BOOLEAN:
                    $result = $this->createVarName
                        ? "{$this->varName} = ::schema::boolean();"
                        : "{$this->varName}->type = ::schema::BOOLEAN;";
                    break;

                case Type::STRING:
                    $result = $this->createVarName
                        ? "{$this->varName} = ::schema::string();"
                        : "{$this->varName}->type = ::schema::STRING;";
                    break;

                case Type::ARR:
                    $result = $this->createVarName
                        ? "{$this->varName} = ::schema::arr();"
                        : "{$this->varName}->type = ::schema::_ARRAY;";
                    break;

                case Type::OBJECT:
                    return;

                case Type::NULL:
                    $result = $this->createVarName
                        ? "{$this->varName} = ::schema::null();"
                        : "{$this->varName}->type = ::schema::NULL;";
                    break;

                default:
                    $types = PhpCode::varExport($this->schema->type);
                    $result = $this->createVarName
                        ? "{$this->varName} = (new ::schema())->setType($types);"
                        : "{$this->varName}->type = $types;";
            }
        } else {
            if ($this->createVarName) {
                $result = "{$this->varName} = new ::schema();";
            }
        }

        if (isset($result)) {
            $this->result->addSnippet(
                new PlaceholderString($result . "\n", array('::schema' => new ReferenceTypeOf(Palette::schemaClass())))
            );
        }
    }

    private function processNamedClass()
    {
        if (!$this->skipProperties
            //&& $this->schema->type === Type::OBJECT
            && $this->schema->properties !== null
        ) {
            $class = $this->phpBuilder->getClass($this->schema, $this->path);
            if ($this->schema->id === 'http://json-schema.org/draft-04/schema#') {
                $this->result->addSnippet(
                    new PlaceholderString("{$this->varName} = ::class::schema();\n",
                        array('::class' => new TypeOf(Palette::schemaClass())))
                );
            } else {
                $this->result->addSnippet(
                    new PlaceholderString("{$this->varName} = ::class::schema();\n",
                        array('::class' => new TypeOf($class)))
                );
            }
            return true;
        }
        return false;
    }

    private function processRef()
    {
        if (!$this->skipProperties
            //&& $this->schema->type === Type::OBJECT
            && !$this->phpBuilder->minimizeRefs
            && $this->schema->getFromRefs()
        ) {
            $class = $this->phpBuilder->getClass($this->schema, $this->path);
            if ($this->schema->id === 'http://json-schema.org/draft-04/schema#') {
                $this->result->addSnippet(
                    new PlaceholderString("{$this->varName} = ::class::schema();\n",
                        array('::class' => new TypeOf(Palette::schemaClass())))
                );
            } else {
                $this->result->addSnippet(
                    new PlaceholderString("{$this->varName} = ::class::schema();\n",
                        array('::class' => new TypeOf($class)))
                );
            }
            return true;
        }
        return false;
    }


    /**
     * @throws Exception
     */
    private function processObject()
    {
        if ($this->schema->type === Type::OBJECT) {
            if (!$this->skipProperties) {
                $this->result->addSnippet(
                    new PlaceholderString("{$this->varName} = ::schema::object();\n",
                        array('::schema' => new TypeOf(Palette::schemaClass())))
                );
            } else {
                $this->result->addSnippet(
                    "{$this->varName}->type = 'object';\n"
                );
            }

        }


        if ($this->schema->additionalProperties !== null) {
            if ($this->schema->additionalProperties instanceof Schema) {
                $this->result->addSnippet(
                    $this->copyTo(new SchemaBuilder(
                        $this->schema->additionalProperties,
                        "{$this->varName}->additionalProperties",
                        $this->path . '->additionalProperties',
                        $this->phpBuilder
                    ))->build()
                );
            } else {
                $val = $this->schema->additionalProperties ? 'true' : 'false';
                $this->result->addSnippet(
                    "{$this->varName}->additionalProperties = $val;\n"
                );
            }
        }

        if ($this->schema->patternProperties !== null) {
            foreach ($this->schema->patternProperties as $pattern => $property) {
                $patternExp = var_export($pattern, true);
                $this->result->addSnippet(
                    $this->copyTo(new SchemaBuilder(
                        $property,
                        "\$patternProperty",
                        $this->path . '->patternProperties->{{$pattern}}',
                        $this->phpBuilder
                    ))->build()
                );
                $this->result->addSnippet("{$this->varName}->setPatternProperty({$patternExp}, \$patternProperty);\n");

            }
        }
    }

    /**
     * @throws Exception
     */
    private function processArray()
    {
        $schema = $this->schema;

        if (is_bool($schema->additionalItems)) {
            $val = $schema->additionalItems ? 'true' : 'false';
            $this->result->addSnippet(
                "{$this->varName}->additionalItems = $val;\n"
            );
        }

        $pathItems = 'items';
        if ($schema->items instanceof ClassStructure) { // todo better check for schema, `getJsonSchema` interface ?
            $items = array();
            $additionalItems = $schema->items;
            $pathItems = 'items';
        } elseif ($schema->items === null) { // items defaults to empty schema so everything is valid
            $items = array();
            $additionalItems = true;
        } else { // listed items
            $items = $schema->items;
            $additionalItems = $schema->additionalItems;
            $pathItems = 'additionalItems';
        }

        if ($items !== null || $additionalItems !== null) {
            if ($additionalItems instanceof ClassStructure) {
                $this->result->addSnippet(
                    $this->copyTo(new SchemaBuilder(
                        $additionalItems,
                        "{$this->varName}->{$pathItems}",
                        $this->path . '->' . $pathItems,
                        $this->phpBuilder
                    ))->build()
                );
            }
        }
    }

    private function processEnum()
    {
        if (!empty($this->schema->enum)) {
            $this->result->addSnippet(
                "{$this->varName}->enum = array(\n"
            );
            foreach ($this->schema->enum as $i => $enumItem) {
                if (isset($this->schema->{Schema::ENUM_NAMES_PROPERTY}[$i])) {
                    $name = PhpCode::makePhpConstantName($this->schema->{Schema::ENUM_NAMES_PROPERTY}[$i]);
                } else {
                    $name = PhpCode::makePhpConstantName($enumItem);
                }
                $value = var_export($enumItem, true);
                if ($this->saveEnumConstInClass !== null && is_scalar($enumItem) && !is_bool($enumItem)) {
                    $this->saveEnumConstInClass->addConstant(new PhpConstant($name, $enumItem));
                    $this->result->addSnippet(
                        "    self::$name,\n"
                    );
                } else {
                    $this->result->addSnippet(
                        "    $value,\n"
                    );
                }

            }
            $this->result->addSnippet(
                ");\n"
            );

        }
    }

    private $skip = [];

    public function skipProperty($name)
    {
        $this->skip[$name] = 1;
        return $this;
    }

    private function copyTo(SchemaBuilder $schemaBuilder)
    {
        $schemaBuilder->skip = $this->skip;
        $schemaBuilder->saveEnumConstInClass = $this->saveEnumConstInClass;
        return $schemaBuilder;
    }

    private function processOther()
    {
        static $skip = null;
        if ($skip === null) {
            $names = Schema::names();
            $skip = array(
                (string)$names->type => 1,
                '$ref' => 1,
                (string)$names->items => 1,
                (string)$names->additionalItems => 1,
                (string)$names->properties => 1,
                (string)$names->additionalProperties => 1,
                (string)$names->patternProperties => 1,
                (string)$names->allOf => 1, // @todo process
                (string)$names->anyOf => 1,
                (string)$names->oneOf => 1,
                (string)$names->not => 1,
                (string)$names->definitions => 1,
                (string)$names->enum => 1,
                (string)$names->fromRef => 1,
                (string)$names->originPath => 1,
            );
        }
        $schemaData = Schema::export($this->schema);
        foreach ((array)$schemaData as $key => $value) {
            if (isset($skip[$key])) {
                continue;
            }
            if (isset($this->skip[$key])) {
                continue;
            }

            //$this->result->addSnippet('/* ' . print_r($value, 1) . '*/' . "\n");
            //echo "{$this->varName}->{$key}\n";
            if ($value instanceof ObjectItem) {
                //$value = $value->jsonSerialize();
                $export = 'new \stdClass()';
            } elseif ($value instanceof \stdClass) {
                $export = '(object)' . PhpCode::varExport((array)$value);
            } elseif (is_string($value)) {
                $export = '"' . str_replace(array('\\', "\n", "\r", "\t", '"'), array('\\\\', '\n', '\r', '\t', '\"'), $value) . '"';
            } else {
                $export = PhpCode::varExport($value);
            }

            $key = PhpCode::makePhpName($key);
            $this->result->addSnippet(
                "{$this->varName}->{$key} = " . $export . ";\n"
            );
        }
    }

    private function processLogic()
    {
        if ($this->schema->not !== null) {
            $this->result->addSnippet(
                $this->copyTo(new SchemaBuilder(
                    $this->schema->not,
                    "{$this->varName}->not",
                    $this->path . '->not',
                    $this->phpBuilder
                ))->build()
            );
        }

        foreach (array('anyOf', 'oneOf', 'allOf') as $logic) {
            if ($this->schema->$logic !== null) {
                foreach ($this->schema->$logic as $index => $schema) {
                    $this->result->addSnippet(
                        $this->copyTo(new SchemaBuilder(
                            $schema,
                            "{$this->varName}->{$logic}[{$index}]",
                            $this->path . "->{$logic}[{$index}]",
                            $this->phpBuilder
                        ))->build()
                    );
                }
            }
        }
    }

    /**
     * @return PhpCode
     * @throws Exception
     */
    public function build()
    {
        $this->result = new PhpCode();

        if ($this->processNamedClass()) {
            return $this->result;
        }

        if ($this->processRef()) {
            return $this->result;
        }

        $this->processType();
        $this->processObject();
        $this->processArray();
        $this->processLogic();
        $this->processEnum();
        $this->processOther();
        $this->processFromRef();

        return $this->result;

    }

    private function processFromRef()
    {
        if ($this->phpBuilder->minimizeRefs) {
            if ($fromRefs = $this->schema->getFromRefs()) {
                $fromRef = $fromRefs[count($fromRefs) - 1];
                $value = var_export($fromRef, 1);
                $this->result->addSnippet("{$this->varName}->setFromRef($value);\n");
            }
            return;
        }
        if ($fromRefs = $this->schema->getFromRefs()) {
            foreach ($fromRefs as $fromRef) {
                $value = var_export($fromRef, 1);
                $this->result->addSnippet("{$this->varName}->setFromRef($value);\n");
            }
        }
    }

    /**
     * @param boolean $skipProperties
     * @return $this
     */
    public function setSkipProperties($skipProperties)
    {
        $this->skipProperties = $skipProperties;
        return $this;
    }

    /**
     * @param PhpClass $saveEnumConstInClass
     * @return $this
     */
    public function setSaveEnumConstInClass($saveEnumConstInClass)
    {
        $this->saveEnumConstInClass = $saveEnumConstInClass;
        return $this;
    }


}