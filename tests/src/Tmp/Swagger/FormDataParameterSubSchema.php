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
 * Built from #/definitions/formDataParameterSubSchema
 */
class FormDataParameterSubSchema extends ClassStructure implements SchemaExporter
{
    const FORM_DATA = 'formData';

    const STRING = 'string';

    const NUMBER = 'number';

    const BOOLEAN = 'boolean';

    const INTEGER = 'integer';

    const _ARRAY = 'array';

    const FILE = 'file';

    const X_PROPERTY_PATTERN = '^x-';

    /** @var bool Determines whether or not this parameter is required or optional. */
    public $required;

    /** @var string Determines the location of the parameter. */
    public $in;

    /** @var string A brief description of the parameter. This could contain examples of use.  GitHub Flavored Markdown is allowed. */
    public $description;

    /** @var string The name of the parameter. */
    public $name;

    /** @var bool allows sending a parameter by name only or with an empty value. */
    public $allowEmptyValue;

    /** @var string */
    public $type;

    /** @var string */
    public $format;

    /** @var PrimitivesItems */
    public $items;

    /** @var string */
    public $collectionFormat;

    /** @var mixed */
    public $default;

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

    /** @var array */
    public $enum;

    /** @var float */
    public $multipleOf;

    /** @var SplObjectStorage Schema storage keeps exported schemas to avoid infinite cycle recursions. */
    private static $schemaStorage;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->required = Schema::boolean();
        $properties->required->description = "Determines whether or not this parameter is required or optional.";
        $properties->required->default = false;
        $properties->in = Schema::string();
        $properties->in->enum = array(
            self::FORM_DATA,
        );
        $properties->in->description = "Determines the location of the parameter.";
        $properties->description = Schema::string();
        $properties->description->description = "A brief description of the parameter. This could contain examples of use.  GitHub Flavored Markdown is allowed.";
        $properties->name = Schema::string();
        $properties->name->description = "The name of the parameter.";
        $properties->allowEmptyValue = Schema::boolean();
        $properties->allowEmptyValue->description = "allows sending a parameter by name only or with an empty value.";
        $properties->allowEmptyValue->default = false;
        $properties->type = Schema::string();
        $properties->type->enum = array(
            self::STRING,
            self::NUMBER,
            self::BOOLEAN,
            self::INTEGER,
            self::_ARRAY,
            self::FILE,
        );
        $properties->format = Schema::string();
        $properties->items = PrimitivesItems::schema();
        $properties->collectionFormat = CollectionFormatWithMulti::schema();
        $properties->default = DefaultClass::schema();
        $properties->maximum = Maximum::schema();
        $properties->exclusiveMaximum = ExclusiveMaximum::schema();
        $properties->minimum = Minimum::schema();
        $properties->exclusiveMinimum = ExclusiveMinimum::schema();
        $properties->maxLength = MaxLength::schema();
        $properties->minLength = MinLength::schema();
        $properties->pattern = Pattern::schema();
        $properties->maxItems = MaxItems::schema();
        $properties->minItems = MinItems::schema();
        $properties->uniqueItems = UniqueItems::schema();
        $properties->enum = Enum::schema();
        $properties->multipleOf = MultipleOf::schema();
        $ownerSchema->additionalProperties = false;
        $patternProperty = VendorExtension::schema();
        $ownerSchema->setPatternProperty('^x-', $patternProperty);
        $ownerSchema->setFromRef('#/definitions/formDataParameterSubSchema');
    }

    /**
     * @param bool $required Determines whether or not this parameter is required or optional.
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
     * @param string $in Determines the location of the parameter.
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setIn($in)
    {
        $this->in = $in;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param string $description A brief description of the parameter. This could contain examples of use.  GitHub Flavored Markdown is allowed.
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
     * @param string $name The name of the parameter.
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param bool $allowEmptyValue allows sending a parameter by name only or with an empty value.
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setAllowEmptyValue($allowEmptyValue)
    {
        $this->allowEmptyValue = $allowEmptyValue;
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
     * @param PrimitivesItems $items
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setItems(PrimitivesItems $items)
    {
        $this->items = $items;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param string $collectionFormat
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setCollectionFormat($collectionFormat)
    {
        $this->collectionFormat = $collectionFormat;
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
        $schema->description = $this->description;
        $schema->type = $this->type;
        $schema->format = $this->format;
        if ($this->items !== null && $this->items instanceof SchemaExporter) {
            $schema->items = $this->items->exportSchema();
        }
        $schema->default = $this->default;
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
        $schema->enum = $this->enum;
        $schema->multipleOf = $this->multipleOf;
        $schema->__fromRef = $this->__fromRef;
        $schema->setDocumentPath($this->getDocumentPath());
        $schema->addMeta($this, 'origin');
        return $schema;
    }
}