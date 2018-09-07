<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swaggest\PhpCodeBuilder\Tests\Tmp\SwaggerMin;

use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Exception\StringException;
use Swaggest\JsonSchema\Helper;
use Swaggest\JsonSchema\InvalidValue;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\SchemaExporter;
use Swaggest\JsonSchema\Structure\ClassStructure;


/**
 * Built from #/definitions/pathParameterSubSchema
 */
class PathParameterSubSchema extends ClassStructure implements SchemaExporter
{
    const PATH = 'path';

    const STRING = 'string';

    const NUMBER = 'number';

    const BOOLEAN = 'boolean';

    const INTEGER = 'integer';

    const _ARRAY = 'array';

    const CSV = 'csv';

    const SSV = 'ssv';

    const TSV = 'tsv';

    const PIPES = 'pipes';

    const X_PROPERTY_PATTERN = '^x-';

    /** @var bool Determines whether or not this parameter is required or optional. */
    public $required;

    /** @var string Determines the location of the parameter. */
    public $in;

    /** @var string A brief description of the parameter. This could contain examples of use.  GitHub Flavored Markdown is allowed. */
    public $description;

    /** @var string The name of the parameter. */
    public $name;

    /** @var string */
    public $type;

    /** @var string */
    public $format;

    /** @var PrimitivesItems */
    public $items;

    /** @var string */
    public $collectionFormat;

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

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->required = Schema::boolean();
        $properties->required->enum = array(
            true,
        );
        $properties->required->description = "Determines whether or not this parameter is required or optional.";
        $properties->in = Schema::string();
        $properties->in->enum = array(
            self::PATH,
        );
        $properties->in->description = "Determines the location of the parameter.";
        $properties->description = Schema::string();
        $properties->description->description = "A brief description of the parameter. This could contain examples of use.  GitHub Flavored Markdown is allowed.";
        $properties->name = Schema::string();
        $properties->name->description = "The name of the parameter.";
        $properties->type = Schema::string();
        $properties->type->enum = array(
            self::STRING,
            self::NUMBER,
            self::BOOLEAN,
            self::INTEGER,
            self::_ARRAY,
        );
        $properties->format = Schema::string();
        $properties->items = PrimitivesItems::schema();
        $properties->collectionFormat = Schema::string();
        $properties->collectionFormat->enum = array(
            self::CSV,
            self::SSV,
            self::TSV,
            self::PIPES,
        );
        $properties->collectionFormat->default = "csv";
        $properties->collectionFormat->setFromRef('#/definitions/collectionFormat');
        $properties->default = new Schema();
        $properties->default->setFromRef('#/definitions/default');
        $properties->maximum = Schema::number();
        $properties->maximum->setFromRef('#/definitions/maximum');
        $properties->exclusiveMaximum = Schema::boolean();
        $properties->exclusiveMaximum->default = false;
        $properties->exclusiveMaximum->setFromRef('#/definitions/exclusiveMaximum');
        $properties->minimum = Schema::number();
        $properties->minimum->setFromRef('#/definitions/minimum');
        $properties->exclusiveMinimum = Schema::boolean();
        $properties->exclusiveMinimum->default = false;
        $properties->exclusiveMinimum->setFromRef('#/definitions/exclusiveMinimum');
        $properties->maxLength = Schema::integer();
        $properties->maxLength->minimum = 0;
        $properties->maxLength->setFromRef('#/definitions/maxLength');
        $properties->minLength = new Schema();
        $properties->minLength->allOf[0] = Schema::integer();
        $properties->minLength->allOf[0]->minimum = 0;
        $properties->minLength->allOf[0]->setFromRef('http://json-schema.org/draft-04/schema#/definitions/positiveInteger');
        $properties->minLength->allOf[1] = new Schema();
        $properties->minLength->allOf[1]->default = 0;
        $properties->minLength->setFromRef('#/definitions/minLength');
        $properties->pattern = Schema::string();
        $properties->pattern->format = "regex";
        $properties->pattern->setFromRef('#/definitions/pattern');
        $properties->maxItems = Schema::integer();
        $properties->maxItems->minimum = 0;
        $properties->maxItems->setFromRef('#/definitions/maxItems');
        $properties->minItems = new Schema();
        $properties->minItems->allOf[0] = Schema::integer();
        $properties->minItems->allOf[0]->minimum = 0;
        $properties->minItems->allOf[0]->setFromRef('http://json-schema.org/draft-04/schema#/definitions/positiveInteger');
        $properties->minItems->allOf[1] = new Schema();
        $properties->minItems->allOf[1]->default = 0;
        $properties->minItems->setFromRef('#/definitions/minItems');
        $properties->uniqueItems = Schema::boolean();
        $properties->uniqueItems->default = false;
        $properties->uniqueItems->setFromRef('#/definitions/uniqueItems');
        $properties->enum = Schema::arr();
        $properties->enum->minItems = 1;
        $properties->enum->uniqueItems = true;
        $properties->enum->setFromRef('#/definitions/enum');
        $properties->multipleOf = Schema::number();
        $properties->multipleOf->minimum = 0;
        $properties->multipleOf->exclusiveMinimum = true;
        $properties->multipleOf->setFromRef('#/definitions/multipleOf');
        $ownerSchema->additionalProperties = false;
        $patternProperty = new Schema();
        $patternProperty->additionalProperties = true;
        $patternProperty->additionalItems = true;
        $patternProperty->description = "Any property starting with x- is valid.";
        $patternProperty->setFromRef('#/definitions/vendorExtension');
        $ownerSchema->setPatternProperty('^x-', $patternProperty);
        $ownerSchema->required = array(
            0 => 'required',
        );
        $ownerSchema->setFromRef('#/definitions/pathParameterSubSchema');
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
     * @param $default
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
     * @param $value
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
        $schema = new Schema();
        $schema->description = $this->description;
        $schema->type = $this->type;
        $schema->format = $this->format;
        $schema->items = $this->items;
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