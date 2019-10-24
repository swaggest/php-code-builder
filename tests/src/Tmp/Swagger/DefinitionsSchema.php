<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swaggest\PhpCodeBuilder\Tests\Tmp\Swagger;

use SplObjectStorage;
use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Exception\StringException;
use Swaggest\JsonSchema\Helper;
use Swaggest\JsonSchema\InvalidValue;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\SchemaExporter;
use Swaggest\JsonSchema\Structure\ClassStructure;


/**
 * A deterministic version of a JSON Schema object.
 * Built from #/definitions/schema
 * @property mixed $default
 * @property mixed $example
 */
class DefinitionsSchema extends ClassStructure implements SchemaExporter
{
    const X_PROPERTY_PATTERN = '^x-';

    /** @var string */
    public $ref;

    /** @var string */
    public $format;

    /** @var string */
    public $title;

    /** @var string */
    public $description;

    /** @var float */
    public $multipleOf;

    /** @var float */
    public $maximum;

    /** @var bool */
    public $exclusiveMaximum;

    /** @var float */
    public $minimum;

    /** @var bool */
    public $exclusiveMinimum;

    /** @var int */
    public $maxLength;

    /** @var int */
    public $minLength;

    /** @var string */
    public $pattern;

    /** @var int */
    public $maxItems;

    /** @var int */
    public $minItems;

    /** @var bool */
    public $uniqueItems;

    /** @var int */
    public $maxProperties;

    /** @var int */
    public $minProperties;

    /** @var string[]|array */
    public $required;

    /** @var array */
    public $enum;

    /** @var DefinitionsSchema|bool */
    public $additionalProperties;

    /** @var array */
    public $type;

    /** @var DefinitionsSchema|DefinitionsSchema[]|array */
    public $items;

    /** @var DefinitionsSchema[]|array */
    public $allOf;

    /** @var DefinitionsSchema[] */
    public $properties;

    /** @var string */
    public $discriminator;

    /** @var bool */
    public $readOnly;

    /** @var Xml */
    public $xml;

    /** @var ExternalDocs information about external documentation */
    public $externalDocs;

    /** @var SplObjectStorage Schema storage keeps exported schemas to avoid infinite cycle recursions. */
    private static $schemaStorage;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->ref = Schema::string();
        $ownerSchema->addPropertyMapping('$ref', self::names()->ref);
        $properties->format = Schema::string();
        $properties->title = HttpJsonSchemaOrgDraft04SchemaPropertiesTitle::schema();
        $properties->description = HttpJsonSchemaOrgDraft04SchemaPropertiesDescription::schema();
        $properties->default = HttpJsonSchemaOrgDraft04SchemaPropertiesDefault::schema();
        $properties->multipleOf = HttpJsonSchemaOrgDraft04SchemaPropertiesMultipleOf::schema();
        $properties->maximum = HttpJsonSchemaOrgDraft04SchemaPropertiesMaximum::schema();
        $properties->exclusiveMaximum = HttpJsonSchemaOrgDraft04SchemaPropertiesExclusiveMaximum::schema();
        $properties->minimum = HttpJsonSchemaOrgDraft04SchemaPropertiesMinimum::schema();
        $properties->exclusiveMinimum = HttpJsonSchemaOrgDraft04SchemaPropertiesExclusiveMinimum::schema();
        $properties->maxLength = HttpJsonSchemaOrgDraft04SchemaDefinitionsPositiveInteger::schema();
        $properties->minLength = HttpJsonSchemaOrgDraft04SchemaDefinitionsPositiveIntegerDefault0::schema();
        $properties->pattern = HttpJsonSchemaOrgDraft04SchemaPropertiesPattern::schema();
        $properties->maxItems = HttpJsonSchemaOrgDraft04SchemaDefinitionsPositiveInteger::schema();
        $properties->minItems = HttpJsonSchemaOrgDraft04SchemaDefinitionsPositiveIntegerDefault0::schema();
        $properties->uniqueItems = HttpJsonSchemaOrgDraft04SchemaPropertiesUniqueItems::schema();
        $properties->maxProperties = HttpJsonSchemaOrgDraft04SchemaDefinitionsPositiveInteger::schema();
        $properties->minProperties = HttpJsonSchemaOrgDraft04SchemaDefinitionsPositiveIntegerDefault0::schema();
        $properties->required = HttpJsonSchemaOrgDraft04SchemaDefinitionsStringArray::schema();
        $properties->enum = HttpJsonSchemaOrgDraft04SchemaPropertiesEnum::schema();
        $properties->additionalProperties = new Schema();
        $properties->additionalProperties->anyOf[0] = DefinitionsSchema::schema();
        $properties->additionalProperties->anyOf[1] = Schema::boolean();
        $properties->additionalProperties->default = (object)array();
        $properties->type = HttpJsonSchemaOrgDraft04SchemaPropertiesType::schema();
        $properties->items = new Schema();
        $properties->items->anyOf[0] = DefinitionsSchema::schema();
        $propertiesItemsAnyOf1 = Schema::arr();
        $propertiesItemsAnyOf1->items = DefinitionsSchema::schema();
        $propertiesItemsAnyOf1->minItems = 1;
        $properties->items->anyOf[1] = $propertiesItemsAnyOf1;
        $properties->items->default = (object)array();
        $properties->allOf = Schema::arr();
        $properties->allOf->items = DefinitionsSchema::schema();
        $properties->allOf->minItems = 1;
        $properties->properties = Schema::object();
        $properties->properties->additionalProperties = DefinitionsSchema::schema();
        $properties->properties->default = (object)array();
        $properties->discriminator = Schema::string();
        $properties->readOnly = Schema::boolean();
        $properties->readOnly->default = false;
        $properties->xml = Xml::schema();
        $properties->externalDocs = ExternalDocs::schema();
        $properties->example = new Schema();
        $ownerSchema->type = Schema::OBJECT;
        $ownerSchema->additionalProperties = false;
        $x = VendorExtension::schema();
        $ownerSchema->setPatternProperty('^x-', $x);
        $ownerSchema->description = "A deterministic version of a JSON Schema object.";
        $ownerSchema->setFromRef('#/definitions/schema');
    }

    /**
     * @param string $ref
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setRef($ref)
    {
        $this->ref = $ref;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param string $format
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setFormat($format)
    {
        $this->format = $format;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param string $title
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param string $description
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param mixed $default
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setDefault($default)
    {
        $this->default = $default;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param float $multipleOf
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setMultipleOf($multipleOf)
    {
        $this->multipleOf = $multipleOf;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param float $maximum
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setMaximum($maximum)
    {
        $this->maximum = $maximum;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param bool $exclusiveMaximum
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setExclusiveMaximum($exclusiveMaximum)
    {
        $this->exclusiveMaximum = $exclusiveMaximum;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param float $minimum
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setMinimum($minimum)
    {
        $this->minimum = $minimum;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param bool $exclusiveMinimum
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setExclusiveMinimum($exclusiveMinimum)
    {
        $this->exclusiveMinimum = $exclusiveMinimum;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param int $maxLength
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setMaxLength($maxLength)
    {
        $this->maxLength = $maxLength;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param int $minLength
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setMinLength($minLength)
    {
        $this->minLength = $minLength;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param string $pattern
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setPattern($pattern)
    {
        $this->pattern = $pattern;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param int $maxItems
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setMaxItems($maxItems)
    {
        $this->maxItems = $maxItems;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param int $minItems
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setMinItems($minItems)
    {
        $this->minItems = $minItems;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param bool $uniqueItems
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setUniqueItems($uniqueItems)
    {
        $this->uniqueItems = $uniqueItems;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param int $maxProperties
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setMaxProperties($maxProperties)
    {
        $this->maxProperties = $maxProperties;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param int $minProperties
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setMinProperties($minProperties)
    {
        $this->minProperties = $minProperties;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param string[]|array $required
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setRequired($required)
    {
        $this->required = $required;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param array $enum
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setEnum($enum)
    {
        $this->enum = $enum;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param DefinitionsSchema|bool $additionalProperties
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setAdditionalProperties($additionalProperties)
    {
        $this->additionalProperties = $additionalProperties;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param array $type
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param DefinitionsSchema|DefinitionsSchema[]|array $items
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setItems($items)
    {
        $this->items = $items;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param DefinitionsSchema[]|array $allOf
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setAllOf($allOf)
    {
        $this->allOf = $allOf;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param DefinitionsSchema[] $properties
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setProperties($properties)
    {
        $this->properties = $properties;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param string $discriminator
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setDiscriminator($discriminator)
    {
        $this->discriminator = $discriminator;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param bool $readOnly
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setReadOnly($readOnly)
    {
        $this->readOnly = $readOnly;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param Xml $xml
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setXml(Xml $xml)
    {
        $this->xml = $xml;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param ExternalDocs $externalDocs information about external documentation
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setExternalDocs(ExternalDocs $externalDocs)
    {
        $this->externalDocs = $externalDocs;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param mixed $example
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setExample($example)
    {
        $this->example = $example;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @return array
     * @codeCoverageIgnoreStart
     */
    public function getXValues()
    {
        $result = array();
        if (!$names = $this->getPatternPropertyNames(self::X_PROPERTY_PATTERN)) {
            return $result;
        }
        foreach ($names as $name) {
            $result[$name] = $this->$name;
        }
        return $result;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param string $name
     * @param mixed $value
     * @return self
     * @throws InvalidValue
     * @codeCoverageIgnoreStart
     */
    public function setXValue($name, $value)
    {
        if (preg_match(Helper::toPregPattern(self::X_PROPERTY_PATTERN), $name)) {
            throw new StringException('Pattern mismatch', StringException::PATTERN_MISMATCH);
        }
        $this->addPatternPropertyName(self::X_PROPERTY_PATTERN, $name);
        $this->{$name} = $value;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @return Schema
     */
    function exportSchema()
    {
        if (null === self::$schemaStorage) {
            self::$schemaStorage = new SplObjectStorage();
        }

        if (self::$schemaStorage->contains($this)) {
            return self::$schemaStorage->offsetGet($this);
        } else {
            $schema = new Schema();
            self::$schemaStorage->attach($this, $schema);
        }
        $schema->ref = $this->ref;
        $schema->format = $this->format;
        $schema->title = $this->title;
        $schema->description = $this->description;
        $schema->default = $this->default;
        $schema->multipleOf = $this->multipleOf;
        $schema->maximum = $this->maximum;
        $schema->exclusiveMaximum = $this->exclusiveMaximum;
        $schema->minimum = $this->minimum;
        $schema->exclusiveMinimum = $this->exclusiveMinimum;
        $schema->maxLength = $this->maxLength;
        $schema->minLength = $this->minLength;
        $schema->pattern = $this->pattern;
        $schema->maxItems = $this->maxItems;
        $schema->minItems = $this->minItems;
        $schema->uniqueItems = $this->uniqueItems;
        $schema->maxProperties = $this->maxProperties;
        $schema->minProperties = $this->minProperties;
        $schema->required = $this->required;
        $schema->enum = $this->enum;
        if ($this->additionalProperties !== null && $this->additionalProperties instanceof SchemaExporter) {
            $schema->additionalProperties = $this->additionalProperties->exportSchema();
        }
        $schema->type = $this->type;
        if ($this->items !== null && $this->items instanceof SchemaExporter) {
            $schema->items = $this->items->exportSchema();
        }
        if (!empty($this->allOf)) {
            foreach ($this->allOf as $i => $item) {
                if ($item instanceof SchemaExporter) {
                    $schema->allOf[$i] = $item->exportSchema();
                }
            }
        }
        if (!empty($this->properties)) {
            foreach ($this->properties as $propertyName => $propertySchema) {
                if (is_string($propertyName) && $propertySchema instanceof SchemaExporter) {
                    $schema->setProperty($propertyName, $propertySchema->exportSchema());
                }
            }
        }
        $schema->__fromRef = $this->__fromRef;
        $schema->setDocumentPath($this->getDocumentPath());
        $schema->addMeta($this, 'origin');
        return $schema;
    }
}