<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swaggest\PhpCodeBuilder\Tests\Tmp\Swagger;

use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Context;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\Structure\ClassStructure;


/**
 * @method static QueryParameterSubSchema import($data, Context $options=null)
 */
class QueryParameterSubSchema extends ClassStructure {
	const QUERY = 'query';

	const STRING = 'string';

	const NUMBER = 'number';

	const BOOLEAN = 'boolean';

	const INTEGER = 'integer';

	const _ARRAY = 'array';

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
		$properties->required->description = "Determines whether or not this parameter is required or optional.";
		$properties->required->default = false;
		$properties->in = Schema::string();
		$properties->in->enum = array(
		    self::QUERY,
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
		);
		$properties->format = Schema::string();
		$properties->items = PrimitivesItems::schema();
		$properties->collectionFormat = CollectionFormatWithMulti::schema();
		$properties->default = HttpJsonSchemaOrgDraft04SchemaPropertiesDefault::schema();
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
		$properties->enum = HttpJsonSchemaOrgDraft04SchemaPropertiesEnum::schema();
		$properties->multipleOf = HttpJsonSchemaOrgDraft04SchemaPropertiesMultipleOf::schema();
		$ownerSchema->additionalProperties = false;
		$patternProperty = VendorExtension::schema();
		$ownerSchema->setPatternProperty('^x-', $patternProperty);
		$ownerSchema->setFromRef('#/definitions/queryParameterSubSchema');
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
	public function setItems($items)
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
}