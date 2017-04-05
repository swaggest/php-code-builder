<?php

namespace Swaggest\PhpCodeBuilder\JsonSchema;


use Swaggest\CodeBuilder\PlaceholderString;
use Swaggest\JsonSchema\Constraint\Type;
use Swaggest\JsonSchema\Schema;
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

    /** @var string */
    private $dataName;

    /** @var bool */
    private $skipProperties;

    /**
     * SchemaBuilder constructor.
     * @param Schema $schema
     * @param string $varName
     * @param $path
     * @param PhpBuilder $phpBuilder
     */
    public function __construct(Schema $schema, $varName, $path, PhpBuilder $phpBuilder)
    {
        $this->schema = $schema;
        $this->varName = $varName;
        $this->phpBuilder = $phpBuilder;
    }

    /**
     * @param string $dataName
     * @return SchemaBuilder
     */
    public function setDataName($dataName)
    {
        $this->dataName = $dataName;
        return $this;
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

    private function processObject()
    {
        if (!$this->skipProperties
            && $this->schema->type === Type::OBJECT
            && $this->schema->properties !== null) {
            $class = $this->phpBuilder->getClass($this->schema, $this->path);
            $this->result->addSnippet(
                new PlaceholderString("{$this->varName} = ::class::schema();\n",
                    array('::class' => new ReferenceTypeOf($class)))
            );
        } else {
            if ($this->schema->type === Type::OBJECT) {
                $this->result->addSnippet(
                    new PlaceholderString("{$this->varName} = ::schema::object();\n",
                        array('::schema' => new ReferenceTypeOf(Palette::schemaClass())))
                );
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

    public function build()
    {
        $this->result = new PhpCode();

        if ($this->schema->ref !== null) {
            return (new self($this->schema->ref->getSchema(), $this->varName, $this->schema->ref->ref, $this->phpBuilder))->build();
        }

        $this->processType();
        $this->processObject();
        $this->processArray();

        /*
        $schemaData = SchemaLoader::create()->dumpSchema($schema);
        if (isset($schemaData->type) && !is_array($schemaData->type)) {
            unset($schemaData->type);
        }
        */

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