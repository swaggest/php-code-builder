<?php

namespace Swaggest\PhpCodeBuilder\JsonSchema;

use Swaggest\JsonSchema\Constraint\Type;
use Swaggest\JsonSchema\Schema;
use Swaggest\PhpCodeBuilder\PhpAnyType;
use Swaggest\PhpCodeBuilder\PhpClass;
use Swaggest\PhpCodeBuilder\PhpClassProperty;
use Swaggest\PhpCodeBuilder\PhpFlags;
use Swaggest\PhpCodeBuilder\PhpFunction;
use Swaggest\PhpCodeBuilder\PhpNamedVar;
use Swaggest\PhpCodeBuilder\PhpStdType;
use Swaggest\PhpCodeBuilder\PhpCode;
use Swaggest\PhpCodeBuilder\Types\OrType;

class PhpBuilder
{
    /** @var \SplObjectStorage|GeneratedClass[] */
    private $generatedClasses;
    private $untitledIndex = 0;

    public function __construct()
    {
        $this->generatedClasses = new \SplObjectStorage();
    }

    /**
     * @param Schema $schema
     * @param array $path
     * @return PhpAnyType
     */
    public function getType(Schema $schema, array $path = array())
    {
        if (is_array($schema->type)) {
            $orType = new OrType();
            foreach ($schema->type as $type) {
                $orType->add($this->typeSwitch($type, $schema, $path));
            }
        } elseif ($schema->type) {
            return $this->typeSwitch($schema->type, $schema, $path);
        }
        return PhpStdType::mixed();
    }


    private function typeSwitch($type, Schema $schema, array $path)
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
                return $this->typeObject($schema, $path);

            case Type::ARR:
                return PhpStdType::arr();

            case Type::NULL:
                return PhpStdType::null();

            default:
                return PhpStdType::mixed();
        }
    }

    private function typeObject(Schema $schema, $path)
    {
        if ($schema->properties !== null) {
            if ($this->generatedClasses->contains($schema)) {
                return $this->generatedClasses[$schema]->class;
            } else {
                return $this->makeClass($schema, $path)->class;
            }
        }

        return PhpStdType::object();
    }

    private function typeArray(Schema $schema, $path)
    {
        // todo implement as above

    }

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->level3 = Schema::integer();
    }

    private function makeClass(Schema $schema, array $path)
    {
        $generatedClass = new GeneratedClass();
        $generatedClass->schema = $schema;

        $class = new PhpClass();
        $class->setName('Untitled' . ++$this->untitledIndex);
        $class->setExtends(Palette::classStructureClass());


        $setupProperties = new PhpFunction('setUpProperties');
        $setupProperties
            ->setVisibility(PhpFlags::VIS_PUBLIC)
            ->setIsStatic(true);
        $setupProperties
            ->addArgument(new PhpNamedVar('properties', Palette::propertiesOrStaticClass()))
            ->addArgument(new PhpNamedVar('ownerSchema', Palette::schemaClass()));

        $body = new PhpCode();

        $class->addMethod($setupProperties);

        $generatedClass->class = $class;
        $generatedClass->path = $path;

        $this->generatedClasses->attach($schema, $generatedClass);

        $schemaBuilder = new SchemaBuilder();

        foreach ($schema->properties->toArray() as $name => $property) {
            $propertyPath = $path;
            $propertyPath[] = $name;
            $class->addProperty(
                new PhpClassProperty($name, $this->getType($property, $propertyPath))
            );
            $body->addSnippet(
                $schemaBuilder->build($property, '$properties->' . $name)
            );
        }

        $setupProperties->setBody($body);

        return $generatedClass;
    }

    /**
     * @return GeneratedClass[]
     */
    public function getGeneratedClasses()
    {
        $result = array();
        foreach ($this->generatedClasses as $schema) {
            $result[] = $this->generatedClasses[$schema];
        }
        return $result;
    }

}