<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swaggest\PhpCodeBuilder\Tests\Tmp\OpenAPI3;

use SplObjectStorage;
use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Exception\StringException;
use Swaggest\JsonSchema\Helper;
use Swaggest\JsonSchema\InvalidValue;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\SchemaExporter;
use Swaggest\JsonSchema\Structure\ClassStructure;


/**
 * Built from #/definitions/Schema
 */
class DefinitionsSchema extends ClassStructure implements SchemaExporter
{
    const _ARRAY = 'array';

    const BOOLEAN = 'boolean';

    const INTEGER = 'integer';

    const NUMBER = 'number';

    const OBJECT = 'object';

    const STRING = 'string';

    const X_PROPERTY_PATTERN = '^x-';

    /** @var string */
    public $title;

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

    /** @var string */
    public $type;

    /** @var DefinitionsSchema|string[] */
    public $not;

    /** @var DefinitionsSchema[]|string[][]|array */
    public $allOf;

    /** @var DefinitionsSchema[]|string[][]|array */
    public $oneOf;

    /** @var DefinitionsSchema[]|string[][]|array */
    public $anyOf;

    /** @var DefinitionsSchema|string[] */
    public $items;

    /** @var DefinitionsSchema[]|string[][] */
    public $properties;

    /** @var DefinitionsSchema|string[]|bool */
    public $additionalProperties;

    /** @var string */
    public $description;

    /** @var string */
    public $format;

    /** @var mixed */
    public $default;

    /** @var bool */
    public $nullable;

    /** @var Discriminator */
    public $discriminator;

    /** @var bool */
    public $readOnly;

    /** @var bool */
    public $writeOnly;

    /** @var mixed */
    public $example;

    /** @var ExternalDocumentation */
    public $externalDocs;

    /** @var bool */
    public $deprecated;

    /** @var XML */
    public $xml;

    /** @var SplObjectStorage Schema storage keeps exported schemas to avoid infinite cycle recursions. */
    private static $schemaStorage;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->title = Schema::string();
        $properties->multipleOf = Schema::number();
        $properties->multipleOf->minimum = 0;
        $properties->multipleOf->exclusiveMinimum = true;
        $properties->maximum = Schema::number();
        $properties->exclusiveMaximum = Schema::boolean();
        $properties->exclusiveMaximum->default = false;
        $properties->minimum = Schema::number();
        $properties->exclusiveMinimum = Schema::boolean();
        $properties->exclusiveMinimum->default = false;
        $properties->maxLength = Schema::integer();
        $properties->maxLength->minimum = 0;
        $properties->minLength = Schema::integer();
        $properties->minLength->default = 0;
        $properties->minLength->minimum = 0;
        $properties->pattern = Schema::string();
        $properties->pattern->format = "regex";
        $properties->maxItems = Schema::integer();
        $properties->maxItems->minimum = 0;
        $properties->minItems = Schema::integer();
        $properties->minItems->default = 0;
        $properties->minItems->minimum = 0;
        $properties->uniqueItems = Schema::boolean();
        $properties->uniqueItems->default = false;
        $properties->maxProperties = Schema::integer();
        $properties->maxProperties->minimum = 0;
        $properties->minProperties = Schema::integer();
        $properties->minProperties->default = 0;
        $properties->minProperties->minimum = 0;
        $properties->required = Schema::arr();
        $properties->required->items = Schema::string();
        $properties->required->minItems = 1;
        $properties->required->uniqueItems = true;
        $properties->enum = Schema::arr();
        $properties->enum->items = new Schema();
        $properties->enum->minItems = 1;
        $properties->enum->uniqueItems = false;
        $properties->type = Schema::string();
        $properties->type->enum = array(
            self::_ARRAY,
            self::BOOLEAN,
            self::INTEGER,
            self::NUMBER,
            self::OBJECT,
            self::STRING,
        );
        $properties->not = new Schema();
        $properties->not->oneOf[0] = DefinitionsSchema::schema();
        $propertiesNotOneOf1 = Schema::object();
        $ref = Schema::string();
        $ref->format = "uri-reference";
        $propertiesNotOneOf1->setPatternProperty('^\\$ref$', $ref);
        $propertiesNotOneOf1->not = new Schema();
        $propertiesNotOneOf1->not->description = "References are removed from validation because of proactive dereferencing";
        $propertiesNotOneOf1->required = array(
            '$ref',
        );
        $propertiesNotOneOf1->setFromRef('#/definitions/Reference');
        $properties->not->oneOf[1] = $propertiesNotOneOf1;
        $properties->allOf = Schema::arr();
        $properties->allOf->items = new Schema();
        $properties->allOf->items->oneOf[0] = DefinitionsSchema::schema();
        $propertiesAllOfItemsOneOf1 = Schema::object();
        $ref = Schema::string();
        $ref->format = "uri-reference";
        $propertiesAllOfItemsOneOf1->setPatternProperty('^\\$ref$', $ref);
        $propertiesAllOfItemsOneOf1->not = new Schema();
        $propertiesAllOfItemsOneOf1->not->description = "References are removed from validation because of proactive dereferencing";
        $propertiesAllOfItemsOneOf1->required = array(
            '$ref',
        );
        $propertiesAllOfItemsOneOf1->setFromRef('#/definitions/Reference');
        $properties->allOf->items->oneOf[1] = $propertiesAllOfItemsOneOf1;
        $properties->oneOf = Schema::arr();
        $properties->oneOf->items = new Schema();
        $properties->oneOf->items->oneOf[0] = DefinitionsSchema::schema();
        $propertiesOneOfItemsOneOf1 = Schema::object();
        $ref = Schema::string();
        $ref->format = "uri-reference";
        $propertiesOneOfItemsOneOf1->setPatternProperty('^\\$ref$', $ref);
        $propertiesOneOfItemsOneOf1->not = new Schema();
        $propertiesOneOfItemsOneOf1->not->description = "References are removed from validation because of proactive dereferencing";
        $propertiesOneOfItemsOneOf1->required = array(
            '$ref',
        );
        $propertiesOneOfItemsOneOf1->setFromRef('#/definitions/Reference');
        $properties->oneOf->items->oneOf[1] = $propertiesOneOfItemsOneOf1;
        $properties->anyOf = Schema::arr();
        $properties->anyOf->items = new Schema();
        $properties->anyOf->items->oneOf[0] = DefinitionsSchema::schema();
        $propertiesAnyOfItemsOneOf1 = Schema::object();
        $ref = Schema::string();
        $ref->format = "uri-reference";
        $propertiesAnyOfItemsOneOf1->setPatternProperty('^\\$ref$', $ref);
        $propertiesAnyOfItemsOneOf1->not = new Schema();
        $propertiesAnyOfItemsOneOf1->not->description = "References are removed from validation because of proactive dereferencing";
        $propertiesAnyOfItemsOneOf1->required = array(
            '$ref',
        );
        $propertiesAnyOfItemsOneOf1->setFromRef('#/definitions/Reference');
        $properties->anyOf->items->oneOf[1] = $propertiesAnyOfItemsOneOf1;
        $properties->items = new Schema();
        $properties->items->oneOf[0] = DefinitionsSchema::schema();
        $propertiesItemsOneOf1 = Schema::object();
        $ref = Schema::string();
        $ref->format = "uri-reference";
        $propertiesItemsOneOf1->setPatternProperty('^\\$ref$', $ref);
        $propertiesItemsOneOf1->not = new Schema();
        $propertiesItemsOneOf1->not->description = "References are removed from validation because of proactive dereferencing";
        $propertiesItemsOneOf1->required = array(
            '$ref',
        );
        $propertiesItemsOneOf1->setFromRef('#/definitions/Reference');
        $properties->items->oneOf[1] = $propertiesItemsOneOf1;
        $properties->properties = Schema::object();
        $properties->properties->additionalProperties = new Schema();
        $properties->properties->additionalProperties->oneOf[0] = DefinitionsSchema::schema();
        $propertiesPropertiesAdditionalPropertiesOneOf1 = Schema::object();
        $ref = Schema::string();
        $ref->format = "uri-reference";
        $propertiesPropertiesAdditionalPropertiesOneOf1->setPatternProperty('^\\$ref$', $ref);
        $propertiesPropertiesAdditionalPropertiesOneOf1->not = new Schema();
        $propertiesPropertiesAdditionalPropertiesOneOf1->not->description = "References are removed from validation because of proactive dereferencing";
        $propertiesPropertiesAdditionalPropertiesOneOf1->required = array(
            '$ref',
        );
        $propertiesPropertiesAdditionalPropertiesOneOf1->setFromRef('#/definitions/Reference');
        $properties->properties->additionalProperties->oneOf[1] = $propertiesPropertiesAdditionalPropertiesOneOf1;
        $properties->additionalProperties = new Schema();
        $properties->additionalProperties->oneOf[0] = DefinitionsSchema::schema();
        $propertiesAdditionalPropertiesOneOf1 = Schema::object();
        $ref = Schema::string();
        $ref->format = "uri-reference";
        $propertiesAdditionalPropertiesOneOf1->setPatternProperty('^\\$ref$', $ref);
        $propertiesAdditionalPropertiesOneOf1->not = new Schema();
        $propertiesAdditionalPropertiesOneOf1->not->description = "References are removed from validation because of proactive dereferencing";
        $propertiesAdditionalPropertiesOneOf1->required = array(
            '$ref',
        );
        $propertiesAdditionalPropertiesOneOf1->setFromRef('#/definitions/Reference');
        $properties->additionalProperties->oneOf[1] = $propertiesAdditionalPropertiesOneOf1;
        $properties->additionalProperties->oneOf[2] = Schema::boolean();
        $properties->additionalProperties->default = true;
        $properties->description = Schema::string();
        $properties->format = Schema::string();
        $properties->default = new Schema();
        $properties->nullable = Schema::boolean();
        $properties->nullable->default = false;
        $properties->discriminator = Discriminator::schema();
        $properties->readOnly = Schema::boolean();
        $properties->readOnly->default = false;
        $properties->writeOnly = Schema::boolean();
        $properties->writeOnly->default = false;
        $properties->example = new Schema();
        $properties->externalDocs = ExternalDocumentation::schema();
        $properties->deprecated = Schema::boolean();
        $properties->deprecated->default = false;
        $properties->xml = XML::schema();
        $ownerSchema->type = Schema::OBJECT;
        $ownerSchema->additionalProperties = false;
        $x = new Schema();
        $ownerSchema->setPatternProperty('^x-', $x);
        $ownerSchema->setFromRef('#/definitions/Schema');
    }

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
     * @param string $type
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
     * @param DefinitionsSchema|string[] $not
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setNot($not)
    {
        $this->not = $not;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param DefinitionsSchema[]|string[][]|array $allOf
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
     * @param DefinitionsSchema[]|string[][]|array $oneOf
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setOneOf($oneOf)
    {
        $this->oneOf = $oneOf;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param DefinitionsSchema[]|string[][]|array $anyOf
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setAnyOf($anyOf)
    {
        $this->anyOf = $anyOf;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param DefinitionsSchema|string[] $items
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
     * @param DefinitionsSchema[]|string[][] $properties
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
     * @param DefinitionsSchema|string[]|bool $additionalProperties
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
     * @param bool $nullable
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setNullable($nullable)
    {
        $this->nullable = $nullable;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param Discriminator $discriminator
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setDiscriminator(Discriminator $discriminator)
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
     * @param bool $writeOnly
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setWriteOnly($writeOnly)
    {
        $this->writeOnly = $writeOnly;
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
     * @param ExternalDocumentation $externalDocs
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setExternalDocs(ExternalDocumentation $externalDocs)
    {
        $this->externalDocs = $externalDocs;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param bool $deprecated
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setDeprecated($deprecated)
    {
        $this->deprecated = $deprecated;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param XML $xml
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setXml(XML $xml)
    {
        $this->xml = $xml;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
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
        $schema->title = $this->title;
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
        $schema->type = $this->type;
        if (!empty($this->allOf)) {
            foreach ($this->allOf as $i => $item) {
                if ($item instanceof SchemaExporter) {
                    $schema->allOf[$i] = $item->exportSchema();
                }
            }
        }
        if (!empty($this->oneOf)) {
            foreach ($this->oneOf as $i => $item) {
                if ($item instanceof SchemaExporter) {
                    $schema->oneOf[$i] = $item->exportSchema();
                }
            }
        }
        if (!empty($this->anyOf)) {
            foreach ($this->anyOf as $i => $item) {
                if ($item instanceof SchemaExporter) {
                    $schema->anyOf[$i] = $item->exportSchema();
                }
            }
        }
        if ($this->items !== null && $this->items instanceof SchemaExporter) {
            $schema->items = $this->items->exportSchema();
        }
        if (!empty($this->properties)) {
            foreach ($this->properties as $propertyName => $propertySchema) {
                if (is_string($propertyName) && $propertySchema instanceof SchemaExporter) {
                    $schema->setProperty($propertyName, $propertySchema->exportSchema());
                }
            }
        }
        if ($this->additionalProperties !== null && $this->additionalProperties instanceof SchemaExporter) {
            $schema->additionalProperties = $this->additionalProperties->exportSchema();
        }
        $schema->description = $this->description;
        $schema->format = $this->format;
        $schema->default = $this->default;
        $schema->__fromRef = $this->__fromRef;
        $schema->setDocumentPath($this->getDocumentPath());
        $schema->addMeta($this, 'origin');
        return $schema;
    }
}