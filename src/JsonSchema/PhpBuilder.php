<?php

namespace Swaggest\PhpCodeBuilder\JsonSchema;

use Swaggest\CodeBuilder\AbstractTemplate;
use Swaggest\CodeBuilder\PlaceholderString;
use Swaggest\JsonSchema\Context;
use Swaggest\JsonSchema\JsonSchema;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\SchemaContract;
use Swaggest\JsonSchema\SchemaExporter;
use Swaggest\PhpCodeBuilder\Exception;
use Swaggest\PhpCodeBuilder\PhpAnyType;
use Swaggest\PhpCodeBuilder\PhpClass;
use Swaggest\PhpCodeBuilder\PhpClassProperty;
use Swaggest\PhpCodeBuilder\PhpCode;
use Swaggest\PhpCodeBuilder\PhpConstant;
use Swaggest\PhpCodeBuilder\PhpDoc;
use Swaggest\PhpCodeBuilder\PhpFlags;
use Swaggest\PhpCodeBuilder\PhpFunction;
use Swaggest\PhpCodeBuilder\PhpNamedVar;
use Swaggest\PhpCodeBuilder\PhpStdType;
use Swaggest\PhpCodeBuilder\Property\AdditionalPropertiesGetter;
use Swaggest\PhpCodeBuilder\Property\AdditionalPropertySetter;
use Swaggest\PhpCodeBuilder\Property\Getter;
use Swaggest\PhpCodeBuilder\Property\PatternPropertiesGetter;
use Swaggest\PhpCodeBuilder\Property\PatternPropertySetter;
use Swaggest\PhpCodeBuilder\Property\Setter;
use Swaggest\PhpCodeBuilder\Types\TypeOf;

class PhpBuilder
{
    const IMPORT_METHOD_PHPDOC_ID = '::import';

    const SCHEMA = 'schema';
    const ORIGIN = 'origin';
    const PROPERTY_NAME = 'property_name';
    const IMPORT_TYPE = 'import_type';

    /** @var \SplObjectStorage */
    private $generatedClasses;

    public function __construct()
    {
        $this->generatedClasses = new \SplObjectStorage();
    }

    public $buildGetters = false;
    public $buildSetters = false;
    public $makeEnumConstants = false;
    public $skipSchemaDescriptions = false;

    /**
     * Use title/description where available instead of keyword in names
     * @var bool
     */
    public $namesFromDescriptions = false;

    /**
     * Squish multiple $ref, a PHP class for each $ref will be created if false
     * @var bool
     */
    public $minimizeRefs = true;

    /** @var PhpBuilderClassHook */
    public $classCreatedHook;

    /** @var PhpBuilderClassHook */
    public $classPreparedHook;

    /**
     * Use default values to initialize properties
     * @var bool
     */
    public $declarePropertyDefaults = false;

    /**
     * Build setter and getter methods for additional properties
     * on a boolean true value for `additionalProperties`.
     * @var bool
     */
    public $buildAdditionalPropertyMethodsOnTrue = false;

    /**
     * @param SchemaContract $schema
     * @param string $path
     * @return PhpAnyType
     * @throws \Swaggest\PhpCodeBuilder\JsonSchema\Exception
     * @throws Exception
     */
    public function getType($schema, $path = '#')
    {
        if (!$schema instanceof Schema) {
            throw new Exception('Could not find Schema instance in SchemaContract: ' . get_class($schema));
        }
        $typeBuilder = new TypeBuilder($schema, $path, $this);
        return $typeBuilder->build();
    }


    /**
     * @param Schema $schema
     * @param string $path
     * @return PhpClass
     * @throws Exception
     * @throws \Swaggest\PhpCodeBuilder\JsonSchema\Exception
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
     * @param Schema $schema
     * @param string $path
     * @return GeneratedClass
     * @throws Exception
     * @throws \Swaggest\PhpCodeBuilder\JsonSchema\Exception
     */
    private function makeClass($schema, $path)
    {
        if (empty($path)) {
            throw new Exception('Empty path');
        }
        $generatedClass = new GeneratedClass();
        $generatedClass->schema = $schema;

        $class = new PhpClass();
        if ($fromRefs = $schema->getFromRefs()) {
            $path = $fromRefs[count($fromRefs) - 1];
        }

        $class->setName(PhpCode::makePhpClassName($path));
        if ($this->classCreatedHook !== null) {
            $this->classCreatedHook->process($class, $path, $schema);
        }
        if (is_null($class->getExtends())) {
            $class->setExtends(Palette::classStructureClass());
        }

        $setupProperties = new PhpFunction('setUpProperties');
        $setupProperties
            ->setVisibility(PhpFlags::VIS_PUBLIC)
            ->setIsStatic(true);
        $setupProperties
            ->addArgument(new PhpNamedVar('properties', Palette::propertiesOrStaticClass()))
            ->addArgument(new PhpNamedVar('ownerSchema', Palette::schemaClass()));

        $body = new PhpCode();

        $class->addMeta($schema, self::SCHEMA);
        $class->addMethod($setupProperties);

        $generatedClass->class = $class;
        $generatedClass->path = $path;

        $this->generatedClasses->attach($schema, $generatedClass);
        if (null !== $this->dynamicIterator) {
            $this->dynamicIterator->push($generatedClass);
        }

        if ($schema->properties) {
            $phpNames = array();
            /**
             * @var string $name
             * @var Schema $property
             */
            foreach ($schema->properties as $name => $property) {
                $propertyName = PhpCode::makePhpName($name);

                $i = 2;
                $basePropertyName = $propertyName;
                while (isset($phpNames[$propertyName])) {
                    $propertyName = $basePropertyName . $i;
                    $i++;
                }
                $phpNames[$propertyName] = true;

                $schemaBuilder = new SchemaBuilder($property, '$properties->' . $propertyName, $path . '->' . $name, $this);
                if ($this->skipSchemaDescriptions) {
                    $schemaBuilder->skipProperty(JsonSchema::names()->description);
                }
                if ($this->makeEnumConstants) {
                    $schemaBuilder->setSaveEnumConstInClass($class);
                }
                $propertyType = $this->getType($property, $path . '->' . $name);
                $phpProperty = new PhpClassProperty($propertyName, $propertyType);
                $phpProperty->addMeta($property, self::SCHEMA);
                $phpProperty->addMeta($name, self::PROPERTY_NAME);

                if (!is_null($property->default) && $this->declarePropertyDefaults) {
                    $phpProperty->setDefault($property->default);
                }

                if ($this->schemaIsNullable($property)) {
                    $phpProperty->setIsMagical(true);
                }

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
                    $body->addSnippet('$ownerSchema->addPropertyMapping(' . var_export($name, true) . ', self::names()->'
                        . $propertyName . ");\n");
                }
            }
        }

        $additionalPropertiesType = null;
        $buildAdditionalPropertiesMethods = false;
        if ($schema->additionalProperties instanceof Schema) {
            $additionalPropertiesType = $this->getType($schema->additionalProperties);
            $buildAdditionalPropertiesMethods = true;
        } elseif ($this->buildAdditionalPropertyMethodsOnTrue && $schema->additionalProperties === true) {
            $additionalPropertiesType = PhpStdType::mixed();
            $buildAdditionalPropertiesMethods = true;
        }

        if ($buildAdditionalPropertiesMethods) {
            $class->addMethod(new AdditionalPropertiesGetter($additionalPropertiesType));
            $class->addMethod(new AdditionalPropertySetter($additionalPropertiesType));
        }

        if ($schema->patternProperties !== null) {
            foreach ($schema->patternProperties as $pattern => $patternProperty) {
                if ($patternProperty instanceof Schema) {
                    $const = new PhpConstant(PhpCode::makePhpConstantName($pattern . '_PROPERTY_PATTERN'), $pattern);
                    $class->addConstant($const);

                    $class->addMethod(new PatternPropertiesGetter($const, $this->getType($patternProperty)));
                    $class->addMethod(new PatternPropertySetter($const, $this->getType($patternProperty)));
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

        $phpDoc = $class->getPhpDoc();
        $type = $this->getType($schema, $path);
        if (!$type instanceof PhpClass) {
            $class->addMeta($type, self::IMPORT_TYPE);
            $phpDoc->add(
                PhpDoc::TAG_METHOD,
                new PlaceholderString(
                    'static :type import($data, :context $options = null)',
                    array(
                        ':type' => new TypeOf($type, true),
                        ':context' => new TypeOf(PhpClass::byFQN(Context::class))
                    )
                ),
                self::IMPORT_METHOD_PHPDOC_ID
            );
        }

        if ($this->classPreparedHook !== null) {
            $this->classPreparedHook->process($class, $path, $schema);
        }

        return $generatedClass;
    }

    /** @var DynamicIterator */
    private $dynamicIterator;

    /**
     * @return GeneratedClass[]|DynamicIterator
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

    /**
     * @param AbstractTemplate $template
     * @return null|Schema
     */
    public static function getSchemaMeta(AbstractTemplate $template)
    {
        return $template->getMeta(self::SCHEMA);
    }

    /**
     * Returns true if null is allowed by schema.
     *
     * @param Schema $property
     * @return bool
     */
    private function schemaIsNullable($property)
    {
        if (!empty($property->enum) && !in_array(null, $property->enum)) {
            return false;
        }

        if ($property->const !== null) {
            return false;
        }

        if (!empty($property->anyOf)) {
            $nullable = false;
            foreach ($property->anyOf as $item) {
                if ($item instanceof Schema) {
                    if ($this->schemaIsNullable($item)) {
                        $nullable = true;
                        break;
                    }
                }
            }
            if (!$nullable) {
                return false;
            }
        }

        if (!empty($property->oneOf)) {
            $nullable = false;
            foreach ($property->oneOf as $item) {
                if ($item instanceof Schema) {
                    if ($this->schemaIsNullable($item)) {
                        $nullable = true;
                        break;
                    }
                }
            }
            if (!$nullable) {
                return false;
            }
        }

        if (!empty($property->allOf)) {
            foreach ($property->allOf as $item) {
                if ($item instanceof Schema) {
                    if (!$this->schemaIsNullable($item)) {
                        return false;
                    }
                }
            }
        }

        if (
            $property->type === null
            || $property->type === Schema::NULL
            || (is_array($property->type) && in_array(Schema::NULL, $property->type))
        ) {
            return true;
        }

        return false;
    }
}


class DynamicIterator implements \Iterator, \ArrayAccess
{
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
     * @param array $rows
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

    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->rows);
    }

    public function offsetGet($offset)
    {
        return $this->rows[$offset];
    }

    public function offsetSet($offset, $value)
    {
        $this->rows[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->rows[$offset]);
    }


}