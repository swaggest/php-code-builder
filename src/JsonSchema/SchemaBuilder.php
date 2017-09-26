<?php

namespace Swaggest\PhpCodeBuilder\JsonSchema;


use Swaggest\CodeBuilder\PlaceholderString;
use Swaggest\JsonSchema\Constraint\Type;
use Swaggest\JsonSchema\JsonSchema;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\Structure\ObjectItem;
use Swaggest\PhpCodeBuilder\PhpCode;
use Swaggest\PhpCodeBuilder\Types\ReferenceTypeOf;

class SchemaBuilder
{
    /** @var Schema */
    private $schema;
    /** @var string */
    private $varName;
    /** @var PhpBuilder */
    private $phpBuilder;
    /** @var string */
    private $path;

    /** @var PhpCode */
    private $result;

    /** @var bool */
    private $skipProperties;

    /**
     * SchemaBuilder constructor.
     * @param JsonSchema|Schema $schema
     * @param string $varName
     * @param $path
     * @param PhpBuilder $phpBuilder
     */
    public function __construct($schema, $varName, $path, PhpBuilder $phpBuilder)
    {
        $this->schema = $schema;
        $this->varName = $varName;
        $this->phpBuilder = $phpBuilder;
        $this->path = $path;
    }

    private function processType()
    {

        $result = "{$this->varName} = ";

        if ($this->schema->type !== null) {
            switch ($this->schema->type) {
                case Type::INTEGER:
                    $result .= '::schema::integer();';
                    break;

                case Type::NUMBER:
                    $result .= '::schema::number();';
                    break;

                case Type::BOOLEAN:
                    $result .= '::schema::boolean();';
                    break;

                case Type::STRING:
                    $result .= '::schema::string();';
                    break;

                case Type::ARR:
                    $result .= '::schema::arr();';
                    break;

                case Type::OBJECT:
                    return;

                case Type::NULL:
                    $result .= '::schema::null();';
                    break;

                default:
                    var_dump($this->schema->type);
                    throw new Exception('Unknown type');
            }
        } else {
            $result .= 'new ::schema();';
        }

        $this->result->addSnippet(
            new PlaceholderString($result . "\n", array('::schema' => new ReferenceTypeOf(Palette::schemaClass())))
        );
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
                        array('::class' => new ReferenceTypeOf(Palette::schemaClass())))
                );
            } else {
                $this->result->addSnippet(
                    new PlaceholderString("{$this->varName} = ::class::schema();\n",
                        array('::class' => new ReferenceTypeOf($class)))
                );
            }
            return true;
        }
        return false;
    }

    private function processObject()
    {
        if ($this->schema->type === Type::OBJECT) {
            if (!$this->skipProperties) {
                $this->result->addSnippet(
                    new PlaceholderString("{$this->varName} = ::schema::object();\n",
                        array('::schema' => new ReferenceTypeOf(Palette::schemaClass())))
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
                    (new SchemaBuilder(
                        $this->schema->additionalProperties,
                        "{$this->varName}->additionalProperties",
                        $this->path . '->additionalProperties',
                        $this->phpBuilder
                    ))->build()
                );
            } elseif (false === $this->schema->additionalProperties) {
                $this->result->addSnippet(
                    "{$this->varName}->additionalProperties = false;\n"
                );
            }
        }

        if ($this->schema->patternProperties !== null) {
            foreach ($this->schema->patternProperties as $pattern => $property) {
                $patternExp = var_export($pattern, true);
                $this->result->addSnippet(
                    (new SchemaBuilder(
                        $property,
                        "{$this->varName}->patternProperties[{$patternExp}]",
                        $this->path . '->patternProperties[{$pattern}]',
                        $this->phpBuilder
                    ))->build()
                );

            }
        }
    }

    private function processArray()
    {
        $schema = $this->schema;

        $pathItems = 'items';
        if ($schema->items instanceof Schema) {
            $items = array();
            $additionalItems = $schema->items;
        } elseif ($schema->items === null) { // items defaults to empty schema so everything is valid
            $items = array();
            $additionalItems = true;
        } else { // listed items
            $items = $schema->items;
            $additionalItems = $schema->additionalItems;
            $pathItems = 'additionalItems';
        }

        if ($items !== null || $additionalItems !== null) {
            $itemsLen = is_array($items) ? count($items) : 0;
            $index = 0;
            if ($index < $itemsLen) {
            } else {
                if ($additionalItems instanceof Schema) {
                    $this->result->addSnippet(
                        (new SchemaBuilder(
                            $additionalItems,
                            "{$this->varName}->{$pathItems}",
                            $this->path . '->' . $pathItems,
                            $this->phpBuilder
                        ))->build()
                    );
                }
            }
        }
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
                (string)$names->fromRef => 1,
                (string)$names->originPath => 1,
            );
        }
        $schemaData = Schema::export($this->schema);
        foreach ((array)$schemaData as $key => $value) {
            if (isset($skip[$key])) {
                continue;
            }

            //$this->result->addSnippet('/* ' . print_r($value, 1) . '*/' . "\n");
            //echo "{$this->varName}->{$key}\n";
            if ($value instanceof ObjectItem) {
                //$value = $value->jsonSerialize();
                $export = 'new \stdClass()';
            } elseif ($value instanceof \stdClass) {
                $export = '(object)' . var_export((array)$value, 1);
            } else {
                $export = var_export($value, 1);
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
                (new SchemaBuilder(
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
                        (new SchemaBuilder(
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

    public function build()
    {
        $this->result = new PhpCode();

        if ($this->schema->ref !== null) { // TODO!
            $path = $this->schema->ref;
            if (!$path) {
                throw new Exception('Empty ref path');
            }
            return (new self($this->schema->ref->getData(), $this->varName, $path, $this->phpBuilder))->build();
        }

        if ($this->processNamedClass()) {
            return $this->result;
        }



        $this->processType();
        $this->processObject();
        $this->processArray();
        $this->processLogic();
        $this->processOther();

        return $this->result;

    }

    /**
     * @param boolean $skipProperties
     */
    public function setSkipProperties($skipProperties)
    {
        $this->skipProperties = $skipProperties;
    }


}