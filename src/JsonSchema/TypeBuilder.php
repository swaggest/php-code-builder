<?php

namespace Swaggest\PhpCodeBuilder\JsonSchema;


use Swaggest\JsonSchema\Constraint\Type;
use Swaggest\JsonSchema\JsonSchema;
use Swaggest\JsonSchema\Schema;
use Swaggest\PhpCodeBuilder\PhpStdType;
use Swaggest\PhpCodeBuilder\Types\ArrayOf;
use Swaggest\PhpCodeBuilder\Types\OrType;

class TypeBuilder
{
    /** @var JsonSchema */
    private $schema;
    /** @var string */
    private $path;
    /** @var PhpBuilder */
    private $phpBuilder;
    /** @var OrType */
    private $result;

    /**
     * TypeBuilder constructor.
     * @param Schema $schema
     * @param $path
     * @param PhpBuilder $phpBuilder
     */
    public function __construct(JsonSchema $schema, $path, PhpBuilder $phpBuilder)
    {
        $this->schema = $schema;
        $this->path = $path;
        $this->phpBuilder = $phpBuilder;
    }

    private function processLogicType()
    {
        $orSchemas = null;
        if ($this->schema->allOf !== null) {
            $orSchemas = $this->schema->allOf;
        } elseif ($this->schema->anyOf !== null) {
            $orSchemas = $this->schema->anyOf;
        } elseif ($this->schema->oneOf !== null) {
            $orSchemas = $this->schema->oneOf;
        }

        if ($orSchemas !== null) {
            foreach ($orSchemas as $item) {
                $this->result->add($this->phpBuilder->getType($item, $this->path));
            }
        }
    }

    private function processArrayType()
    {
        $schema = $this->schema;

        $pathItems = (string)Schema::names()->items;
        if ($schema->items instanceof Schema) {
            $items = array();
            $additionalItems = $schema->items;
        } elseif ($schema->items === null) { // items defaults to empty schema so everything is valid
            $items = array();
            $additionalItems = true;
        } else { // listed items
            $items = $schema->items;
            $additionalItems = $schema->additionalItems;
            $pathItems = (string)Schema::names()->additionalItems;
        }

        if ($items !== null || $additionalItems !== null) {
            $itemsLen = is_array($items) ? count($items) : 0;
            $index = 0;
            if ($index < $itemsLen) {
            } else {
                if ($additionalItems instanceof Schema) {
                    $this->result->add(new ArrayOf($this->phpBuilder->getType($additionalItems, $this->path . '->' . $pathItems)));
                }
            }
        }
    }

    private function processObjectType()
    {
        if ($this->schema->patternProperties !== null) {
            foreach ($this->schema->patternProperties as $pattern => $schema) {
                $this->result->add(new ArrayOf($this->phpBuilder->getType($schema, $this->path . '->' . $pattern)));
            }
        }

        if ($this->schema->additionalProperties instanceof Schema) {
            $this->result->add(new ArrayOf($this->phpBuilder->getType(
                $this->schema->additionalProperties,
                $this->path . '->' . (string)Schema::names()->additionalProperties)
            ));
        }
    }

    private function typeSwitch($type)
    {
        switch ($type) {
            case Type::INTEGER:
                return PhpStdType::int();

            case Type::NUMBER:
                return PhpStdType::float();

            case TYPE::BOOLEAN:
                return PhpStdType::bool();

            case Type::STRING:
                return PhpStdType::string();

            /*
            case Type::OBJECT:
                return PhpStdType::object();
            */

            case Type::ARR:
                return PhpStdType::arr();

            case Type::NULL:
                return PhpStdType::null();

            default:
                return null;
        }
    }

    private function processNamedClass(JsonSchema $schema, $path)
    {
        if ($schema->properties !== null) {
            $class = $this->phpBuilder->getClass($schema, $path);
            $this->result->add($class);
        }
    }

    /**
     * @return OrType
     */
    public function build()
    {
        $schema = $this->schema;

        $this->result = new OrType();

        if (null !== $path = $this->schema->getFromRef()) {
            $this->path = $this->schema->getFromRef();
            //$this->result->add($this->phpBuilder->getType($this->schema->ref->getData(), $this->schema->ref->ref));
        }


        $this->processNamedClass($this->schema, $this->path);
        $this->processLogicType();
        $this->processArrayType();
        $this->processObjectType();

        if (is_array($this->schema->type)) {
            foreach ($this->schema->type as $type) {
                $this->result->add($this->typeSwitch($type));
            }
        } elseif ($this->schema->type) {
            $this->result->add($this->typeSwitch($this->schema->type));
        }

        return $this->result;

    }
}