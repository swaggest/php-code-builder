<?php

namespace Swaggest\PhpCodeBuilder\JsonSchema;


use Swaggest\JsonSchema\Constraint\Type;
use Swaggest\JsonSchema\Schema;
use Swaggest\PhpCodeBuilder\PhpAnyType;
use Swaggest\PhpCodeBuilder\PhpStdType;
use Swaggest\PhpCodeBuilder\Types\ArrayOf;
use Swaggest\PhpCodeBuilder\Types\OrType;

class TypeBuilder
{
    /** @var Schema */
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
     * @param string $path
     * @param PhpBuilder $phpBuilder
     */
    public function __construct($schema, $path, PhpBuilder $phpBuilder)
    {
        $this->schema = $schema;
        $this->path = $path;
        $this->phpBuilder = $phpBuilder;
    }

    /**
     * @throws Exception
     * @throws \Swaggest\PhpCodeBuilder\Exception
     */
    private function processLogicType()
    {
        if ($this->schema->allOf !== null) {
            foreach ($this->schema->allOf as $i => $item) {
                $this->result->add($this->phpBuilder->getType($item, $this->path . '->allOf[' . $i . ']'));
            }
        }

        if ($this->schema->anyOf !== null) {
            foreach ($this->schema->anyOf as $i => $item) {
                $this->result->add($this->phpBuilder->getType($item, $this->path . '->anyOf[' . $i . ']'));
            }
        }

        if ($this->schema->oneOf !== null) {
            foreach ($this->schema->oneOf as $i => $item) {
                $this->result->add($this->phpBuilder->getType($item, $this->path . '->oneOf[' . $i . ']'));
            }
        }
    }

    /**
     * @throws Exception
     * @throws \Swaggest\PhpCodeBuilder\Exception
     */
    private function processAdditionalPatternProperties()
    {
        $schema = $this->schema;

        if ($schema->additionalProperties instanceof Schema) {
            $type = $this->phpBuilder->getType($schema->additionalProperties, $this->path . '->additionalProperties');
            if ($type !== PhpStdType::mixed()) {
                $this->result->add(new ArrayOf($type));
            }
        }

        if ($schema->patternProperties !== null) {
            foreach ($schema->patternProperties as $pattern => $property) {
                if ($property instanceof Schema) {
                    $type = $this->phpBuilder->getType($property, $this->path . "->patternProperties->{{$pattern}}");
                    if ($type !== PhpStdType::mixed()) {
                        $this->result->add(new ArrayOf($type));
                    }
                }
            }
        }

    }


    /**
     * @throws Exception
     * @throws \Swaggest\PhpCodeBuilder\Exception
     */
    private function processArrayType()
    {
        $schema = $this->schema;

        /** @var string $pathItems */
        $pathItems = Schema::names()->items;
        if ($this->isSchema($schema->items)) {
            $items = array();
            $additionalItems = $schema->items;
        } elseif ($schema->items === null) { // items defaults to empty schema so everything is valid
            $items = array();
            $additionalItems = true;
        } else { // listed items
            $items = $schema->items;
            $additionalItems = $schema->additionalItems;
            $pathItems = Schema::names()->additionalItems;
        }

        $itemsLen = is_array($items) ? count($items) : 0;
        $index = 0;
        if ($index < $itemsLen) {
        } else {
            if ($additionalItems instanceof Schema) {
                $this->result->add(new ArrayOf($this->phpBuilder->getType($additionalItems, $this->path . '->' . $pathItems)));
            }
        }
    }

    private function isSchema($var)
    {
        return $var instanceof Schema;
    }

    /**
     * @throws Exception
     * @throws \Swaggest\PhpCodeBuilder\Exception
     */
    private function processObjectType()
    {
        if ($this->schema->patternProperties !== null) {
            foreach ($this->schema->patternProperties as $pattern => $schema) {
                //$this->result->add(new ArrayOf($this->phpBuilder->getType($schema, $this->path . '->' . $pattern)));
            }
        }


        if ($this->schema->additionalProperties instanceof Schema) {
            $this->result->add(new ArrayOf($this->phpBuilder->getType(
                $this->schema->additionalProperties,
                $this->path . '->' . Schema::names()->additionalProperties)
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

    /**
     * @throws Exception
     * @throws \Swaggest\PhpCodeBuilder\Exception
     */
    private function processNamedClass()
    {
        if ($this->schema->properties !== null) {
            $class = $this->phpBuilder->getClass($this->schema, $this->path);
            $this->result->add($class);
        }
    }

    /**
     * @return PhpAnyType
     * @throws Exception
     * @throws \Swaggest\PhpCodeBuilder\Exception
     */
    public function build()
    {
        $this->result = new OrType();
        if ($this->schema === null) {
            throw new Exception('Null schema');
        }

        if ($fromRefs = $this->schema->getFromRefs()) {
            $this->path = $fromRefs[count($fromRefs) - 1];
            //$this->result->add($this->phpBuilder->getType($this->schema->ref->getData(), $this->schema->ref->ref));
        }


        $this->processNamedClass();
        $this->processLogicType();
        $this->processArrayType();
        $this->processObjectType();
        $this->processAdditionalPatternProperties();

        if (is_array($this->schema->type)) {
            foreach ($this->schema->type as $type) {
                $this->result->add($this->typeSwitch($type));
            }
        } elseif ($this->schema->type) {
            $this->result->add($this->typeSwitch($this->schema->type));
        }

        return $this->result->simplify();

    }
}