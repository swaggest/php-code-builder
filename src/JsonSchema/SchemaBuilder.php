<?php

namespace Swaggest\PhpCodeBuilder\JsonSchema;


use Swaggest\CodeBuilder\PlaceholderString;
use Swaggest\JsonSchema\Constraint\Type;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\SchemaContract;
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
     * @param Schema|SchemaContract $schema
     * @param string $varName
     * @param string $path
     * @param PhpBuilder $phpBuilder
     * @param bool $createVarName
     * @throws \Exception
     */
    public function __construct($schema, $varName, $path, PhpBuilder $phpBuilder, $createVarName = true)
    {
        if (!$schema instanceof Schema) {
            throw new Exception('Could not find Schema instance in SchemaContract: ' . get_class($schema));
        }
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
                if ($property instanceof Schema) {
                    $patternExp = var_export($pattern, true);
                    $this->result->addSnippet(
                        $this->copyTo(new SchemaBuilder(
                            $property,
                            "\$patternProperty",
                            $this->path . "->patternProperties->{{$pattern}}",
                            $this->phpBuilder
                        ))->build()
                    );
                    $this->result->addSnippet("{$this->varName}->setPatternProperty({$patternExp}, \$patternProperty);\n");
                }
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
            $additionalItems = $schema->items;
            $pathItems = 'items';
        } elseif ($schema->items === null) { // items defaults to empty schema so everything is valid
            $additionalItems = true;
        } else { // listed items
            $additionalItems = $schema->additionalItems;
            $pathItems = 'additionalItems';
        }

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
        static $skip = null, $emptySchema = null, $names = null;
        if ($skip === null) {
            $emptySchema = new Schema();
            $names = Schema::names();
            $skip = array(
                $names->type => 1,
                Schema::PROP_REF => 1,
                $names->items => 1,
                $names->additionalItems => 1,
                $names->properties => 1,
                $names->additionalProperties => 1,
                $names->patternProperties => 1,
                $names->allOf => 1, // @todo process
                $names->anyOf => 1,
                $names->oneOf => 1,
                $names->not => 1,
                $names->definitions => 1,
                $names->enum => 1,
                $names->if => 1,
                $names->then => 1,
                $names->else => 1,
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

            if (!property_exists($emptySchema, $key) && $key !== $names->const && $key[0] !== '$') {
                continue;
            }

            if ($names->required == $key && is_array($value)) {
                $export = "array(\n";
                foreach ($value as $item) {
                    if (PhpCode::makePhpName($item) === $item) {
                        $expItem = 'self::names()->' . $item;
                    } else {
                        $expItem = PhpCode::varExport($item);
                    }
                    $export .= '    ' . $expItem . ",\n";
                }
                $export .= ")";
                $this->result->addSnippet(
                    "{$this->varName}->{$key} = " . $export . ";\n"
                );
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
        $names = Schema::names();
        /** @var string $keyword */
        foreach (array($names->not, $names->if, $names->then, $names->else) as $keyword) {
            if ($this->schema->$keyword !== null) {
                $schema = $this->schema->$keyword;
                $path = $this->path . '->' . $keyword;
                if ($schema instanceof Schema && !empty($schema->getFromRefs())) {
                    $path = $schema->getFromRefs()[0];
                }
                $this->result->addSnippet(
                    $this->copyTo(new SchemaBuilder(
                        $schema,
                        "{$this->varName}->{$keyword}",
                        $path,
                        $this->phpBuilder
                    ))->build()
                );
            }

        }

        foreach (array($names->anyOf, $names->oneOf, $names->allOf) as $keyword) {
            if ($this->schema->$keyword !== null) {
                foreach ($this->schema->$keyword as $index => $schema) {
                    $path = $this->path . "->{$keyword}[{$index}]";
                    if ($schema instanceof Schema && !empty($schema->getFromRefs())) {
                        $path = $schema->getFromRefs()[0];
                    }
                    $varName = '$' . PhpCode::makePhpName("{$this->varName}->{$keyword}[{$index}]");
                    $schemaInit = $this->copyTo(new SchemaBuilder(
                        $schema,
                        $varName,
                        $path,
                        $this->phpBuilder
                    ))->build();

                    if (count($schemaInit->snippets) === 1) { // Init in single statement can be just assigned.
                        $this->result->addSnippet($this->copyTo(new SchemaBuilder(
                            $schema,
                            "{$this->varName}->{$keyword}[{$index}]",
                            $this->path . "->{$keyword}[{$index}]",
                            $this->phpBuilder
                        ))->build());
                    } else {
                        $this->result->addSnippet($schemaInit);
                        $this->result->addSnippet(<<<PHP
{$this->varName}->{$keyword}[{$index}] = {$varName};

PHP
                        );
                    }
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
                $value = var_export($fromRef, true);
                $this->result->addSnippet("{$this->varName}->setFromRef($value);\n");
            }
            return;
        }
        if ($fromRefs = $this->schema->getFromRefs()) {
            foreach ($fromRefs as $fromRef) {
                $value = var_export($fromRef, true);
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