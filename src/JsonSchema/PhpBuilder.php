<?php

namespace Swaggest\PhpCodeBuilder\JsonSchema;

use Swaggest\CodeBuilder\AbstractTemplate;
use Swaggest\CodeBuilder\PlaceholderString;
use Swaggest\JsonSchema\Context;
use Swaggest\JsonSchema\JsonSchema;
use Swaggest\JsonSchema\Schema;
use Swaggest\PhpCodeBuilder\Exception;
use Swaggest\PhpCodeBuilder\PhpAnyType;
use Swaggest\PhpCodeBuilder\PhpClass;
use Swaggest\PhpCodeBuilder\PhpClassProperty;
use Swaggest\PhpCodeBuilder\PhpDoc;
use Swaggest\PhpCodeBuilder\PhpFlags;
use Swaggest\PhpCodeBuilder\PhpFunction;
use Swaggest\PhpCodeBuilder\PhpNamedVar;
use Swaggest\PhpCodeBuilder\PhpCode;
use Swaggest\PhpCodeBuilder\Property\Getter;
use Swaggest\PhpCodeBuilder\Property\Setter;
use Swaggest\PhpCodeBuilder\Types\TypeOf;

/**
 * @todo properly process $ref, $schema property names
 */
class PhpBuilder
{
    const IMPORT_METHOD_PHPDOC_ID = '::import';

    const SCHEMA = 'schema';
    const ORIGIN = 'origin';
    const PROPERTY_NAME = 'property_name';

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

    /**
     * @param Schema $schema
     * @param string $path
     * @return PhpAnyType
     * @throws \Swaggest\PhpCodeBuilder\JsonSchema\Exception
     */
    public function getType($schema, $path = '#')
    {
        $typeBuilder = new TypeBuilder($schema, $path, $this);
        return $typeBuilder->build();
    }


    /**
     * @param Schema $schema
     * @param $path
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
     * @param $path
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
        if (null !== $fromRef = $schema->getFromRef()) {
            $path = $fromRef;
        }

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
            foreach ($schema->properties as $name => $property) {
                $i = '';
                do {
                    $propertyName = PhpCode::makePhpName($name . $i);
                    $i .= 'a';
                } while (isset($phpNames[$propertyName]));
                $phpNames[$propertyName] = true;

                $schemaBuilder = new SchemaBuilder($property, '$properties->' . $propertyName, $path . '->' . $name, $this);
                if ($this->skipSchemaDescriptions) {
                    $schemaBuilder->skipProperty(JsonSchema::names()->description);
                }
                if ($this->makeEnumConstants) {
                    $schemaBuilder->setSaveEnumConstInClass($class);
                }
                $phpProperty = new PhpClassProperty($propertyName, $this->getType($property, $path . '->' . $name));
                $phpProperty->addMeta($property, self::SCHEMA);
                $phpProperty->addMeta($name, self::PROPERTY_NAME);
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

        $phpDoc = $class->getPhpDoc();
        $type = $this->getType($schema, $path);
        if (!$type instanceof PhpClass) {
            $phpDoc->add(
                PhpDoc::TAG_METHOD,
                new PlaceholderString(
                    'static :type import($data, :context $options=null)',
                    array(
                        ':type' => new TypeOf($type, true),
                        ':context' => new TypeOf(PhpClass::byFQN(Context::class))
                    )
                ),
                self::IMPORT_METHOD_PHPDOC_ID
            );
        }
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

    /**
     * @param AbstractTemplate $template
     * @return null|Schema
     */
    public static function getSchemaMeta(AbstractTemplate $template)
    {
        return $template->getMeta(self::SCHEMA);
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