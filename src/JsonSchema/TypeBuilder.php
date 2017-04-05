<?php

namespace Swaggest\PhpCodeBuilder\JsonSchema;


use Swaggest\JsonSchema\Constraint\Type;
use Swaggest\JsonSchema\Schema;
use Swaggest\PhpCodeBuilder\PhpStdType;
use Swaggest\PhpCodeBuilder\Types\OrType;

class TypeBuilder
{
    /** @var Schema */
    private $schema;
    /** @var array */
    private $path;
    /** @var PhpBuilder */
    private $phpBuilder;
    /** @var OrType */
    private $result;

    /**
     * TypeBuilder constructor.
     * @param Schema $schema
     * @param array $path
     * @param PhpBuilder $phpBuilder
     */
    public function __construct(Schema $schema, array $path, PhpBuilder $phpBuilder)
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

            case Type::OBJECT:
                return $this->typeObject($this->schema, $this->path);

            case Type::ARR:
                return PhpStdType::arr();

            case Type::NULL:
                return PhpStdType::null();

            default:
                return null;
        }
    }

    private function typeObject(Schema $schema, $path)
    {
        if ($schema->properties !== null) {
            return $this->phpBuilder->getClass($schema, $path);
        }

        return PhpStdType::object();
    }

    private function typeArray(Schema $schema, $path)
    {
        // todo implement as above

    }


    /**
     * @return OrType
     */
    public function build()
    {
        $this->result = new OrType();

        if ($this->schema->ref !== null) {
            $this->result->add($this->phpBuilder->getType($this->schema->ref->getSchema(), array($this->schema->ref->ref)));
        }

        $this->processLogicType();
        $this->processArrayType();

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