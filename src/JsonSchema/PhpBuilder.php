<?php

namespace Swaggest\PhpCodeBuilder\JsonSchema;

use Swaggest\JsonSchema\JsonSchema;
use Swaggest\PhpCodeBuilder\Exception;
use Swaggest\PhpCodeBuilder\PhpAnyType;
use Swaggest\PhpCodeBuilder\PhpClass;
use Swaggest\PhpCodeBuilder\PhpClassProperty;
use Swaggest\PhpCodeBuilder\PhpFlags;
use Swaggest\PhpCodeBuilder\PhpFunction;
use Swaggest\PhpCodeBuilder\PhpNamedVar;
use Swaggest\PhpCodeBuilder\PhpCode;
use Swaggest\PhpCodeBuilder\Property\Getter;
use Swaggest\PhpCodeBuilder\Property\Setter;

/**
 * @todo properly process $ref, $schema property names
 */
class PhpBuilder
{
    /** @var \SplObjectStorage|GeneratedClass[] */
    private $generatedClasses;
    private $untitledIndex = 0;

    public function __construct()
    {
        $this->generatedClasses = new \SplObjectStorage();
    }

    public $buildGetters = false;
    public $buildSetters = false;
    public $makeEnumConstants = false;
    public $skipSchemaDescriptions = false;

    /** @var PhpBuilderClassCreatedHook */
    public $classCreatedHook;

    public $baseNamespace;

    /**
     * @param JsonSchema $schema
     * @param string $path
     * @return PhpAnyType
     */
    public function getType($schema, $path = '#')
    {
        $typeBuilder = new TypeBuilder($schema, $path, $this);
        return $typeBuilder->build();
    }


    /**
     * @param JsonSchema|\Swaggest\JsonSchema\SwaggerSchema\Schema $schema
     * @param $path
     * @return PhpClass
     * @throws Exception
     */
    public function getClass($schema, $path)
    {
        if ($this->generatedClasses->contains($schema)) {
            return $this->generatedClasses[$schema]->class;
        } else {
            return $this->makeClass($schema, $path)->class;
        }
    }

    /**
     * @param JsonSchema $schema
     * @param $path
     * @return GeneratedClass
     * @throws Exception
     */
    private function makeClass($schema, $path)
    {
        if (empty($path)) {
            throw new Exception('Empty path');
        }
        $generatedClass = new GeneratedClass();
        $generatedClass->schema = $schema;

        $class = new PhpClass();
        $class->setName(PhpCode::makePhpName($path, false));
        if ($this->classCreatedHook !== null) {
            $this->classCreatedHook->process($class, $path, $schema);
        }
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
        if (null !== $this->dynamicIterator) {
            $this->dynamicIterator->push($generatedClass);
        }

        if ($schema->properties) {
            foreach ($schema->properties as $name => $property) {
                $propertyName = PhpCode::makePhpName($name);

                $schemaBuilder = new SchemaBuilder($property, '$properties->' . $propertyName, $path . '->' . $name, $this);
                if ($this->skipSchemaDescriptions) {
                    $schemaBuilder->skipProperty(JsonSchema::names()->description);
                }
                if ($this->makeEnumConstants) {
                    $schemaBuilder->setSaveEnumConstInClass($class);
                }
                $phpProperty = new PhpClassProperty($propertyName, $this->getType($property, $path . '->' . $name));
                if ($property->description) {
                    $phpProperty->setDescription($property->description);
                }
                $class->addProperty($phpProperty);
                if ($this->buildGetters) {
                    $class->addMethod(new Getter($phpProperty));
                }
                if ($this->buildSetters) {
                    $class->addMethod(new Setter($phpProperty, true));
                }
                $body->addSnippet(
                    $schemaBuilder->build()
                );
                if ($propertyName != $name) {
                    $body->addSnippet('$ownerSchema->addPropertyMapping(' . var_export($name, 1) . ', self::names()->'
                        . $propertyName . ");\n");
                }
            }
        }

        $schemaBuilder = new SchemaBuilder($schema, '$ownerSchema', $path, $this, false);
        if ($this->skipSchemaDescriptions) {
            $schemaBuilder->skipProperty(JsonSchema::names()->description);
        }
        $schemaBuilder->setSkipProperties(true);
        $body->addSnippet($schemaBuilder->build());

        $setupProperties->setBody($body);

        return $generatedClass;
    }

    /** @var DynamicIterator */
    private $dynamicIterator;

    /**
     * @return GeneratedClass[]
     */
    public function getGeneratedClasses()
    {
        $result = array();
        foreach ($this->generatedClasses as $schema) {
            $result[] = $this->generatedClasses[$schema];
        }
        $iterator = new DynamicIterator($result);
        $this->dynamicIterator = $iterator;
        return $iterator;
    }
}


class DynamicIterator implements \Iterator{
    private $rows;
    private $current;
    private $key;
    private $valid;

    public function push($item)
    {
        $this->rows[] = $item;
        return $this;
    }

    /**
     * DynamicIterator constructor.
     * @param $rows
     */
    public function __construct($rows = array())
    {
        $this->rows = $rows;
    }


    public function current()
    {
        return $this->current;
    }

    public function next()
    {
        if (empty($this->rows)) {
            $this->valid = false;
            return;
        }
        $this->current = array_shift($this->rows);
        $this->valid = true;
        ++$this->key;
    }

    public function key()
    {
        return $this->key;
    }

    public function valid()
    {
        return $this->valid;
    }

    public function rewind()
    {
        $this->next();
    }
}