<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swaggest\PhpCodeBuilder\Tests\Tmp\SwaggerMin;

use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Context;
use Swaggest\JsonSchema\Schema as Schema1;
use Swaggest\JsonSchema\SchemaExporter;
use Swaggest\JsonSchema\Structure\ClassStructure;


/**
 * A deterministic version of a JSON Schema object.
 * Built from #/definitions/schema
 * @method static Schema import($data, Context $options=null)
 */
class Schema extends ClassStructure implements SchemaExporter {
	const _ARRAY = 'array';

	const BOOLEAN = 'boolean';

	const INTEGER = 'integer';

	const NULL = 'null';

	const NUMBER = 'number';

	const OBJECT = 'object';

	const STRING = 'string';

	/** @var string */
	public $ref;

	/** @var string */
	public $format;

	/** @var string */
	public $title;

	/** @var string */
	public $description;

	public $default;

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

	/** @var Schema|bool */
	public $additionalProperties;

	/** @var array */
	public $type;

	/** @var Schema|Schema[]|array */
	public $items;

	/** @var Schema[]|array */
	public $allOf;

	/** @var Schema[] */
	public $properties;

	/** @var string */
	public $discriminator;

	/** @var bool */
	public $readOnly;

	/** @var Xml */
	public $xml;

	/** @var ExternalDocs information about external documentation */
	public $externalDocs;

	public $example;

	/**
	 * @param Properties|static $properties
	 * @param Schema1 $ownerSchema
	 */
	public static function setUpProperties($properties, Schema1 $ownerSchema)
	{
		$properties->ref = Schema1::string();
		$ownerSchema->addPropertyMapping('$ref', self::names()->ref);
		$properties->format = Schema1::string();
		$properties->title = Schema1::string();
		$properties->title->setFromRef('http://json-schema.org/draft-04/schema#/properties/title');
		$properties->description = Schema1::string();
		$properties->description->setFromRef('http://json-schema.org/draft-04/schema#/properties/description');
		$properties->default = new Schema1();
		$properties->default->setFromRef('http://json-schema.org/draft-04/schema#/properties/default');
		$properties->multipleOf = Schema1::number();
		$properties->multipleOf->minimum = 0;
		$properties->multipleOf->exclusiveMinimum = true;
		$properties->multipleOf->setFromRef('http://json-schema.org/draft-04/schema#/properties/multipleOf');
		$properties->maximum = Schema1::number();
		$properties->maximum->setFromRef('http://json-schema.org/draft-04/schema#/properties/maximum');
		$properties->exclusiveMaximum = Schema1::boolean();
		$properties->exclusiveMaximum->default = false;
		$properties->exclusiveMaximum->setFromRef('http://json-schema.org/draft-04/schema#/properties/exclusiveMaximum');
		$properties->minimum = Schema1::number();
		$properties->minimum->setFromRef('http://json-schema.org/draft-04/schema#/properties/minimum');
		$properties->exclusiveMinimum = Schema1::boolean();
		$properties->exclusiveMinimum->default = false;
		$properties->exclusiveMinimum->setFromRef('http://json-schema.org/draft-04/schema#/properties/exclusiveMinimum');
		$properties->maxLength = Schema1::integer();
		$properties->maxLength->minimum = 0;
		$properties->maxLength->setFromRef('http://json-schema.org/draft-04/schema#/definitions/positiveInteger');
		$properties->minLength = new Schema1();
		$properties->minLength->allOf[0] = Schema1::integer();
		$properties->minLength->allOf[0]->minimum = 0;
		$properties->minLength->allOf[0]->setFromRef('http://json-schema.org/draft-04/schema#/definitions/positiveInteger');
		$properties->minLength->allOf[1] = new Schema1();
		$properties->minLength->allOf[1]->default = 0;
		$properties->minLength->setFromRef('http://json-schema.org/draft-04/schema#/definitions/positiveIntegerDefault0');
		$properties->pattern = Schema1::string();
		$properties->pattern->format = "regex";
		$properties->pattern->setFromRef('http://json-schema.org/draft-04/schema#/properties/pattern');
		$properties->maxItems = Schema1::integer();
		$properties->maxItems->minimum = 0;
		$properties->maxItems->setFromRef('http://json-schema.org/draft-04/schema#/definitions/positiveInteger');
		$properties->minItems = new Schema1();
		$properties->minItems->allOf[0] = Schema1::integer();
		$properties->minItems->allOf[0]->minimum = 0;
		$properties->minItems->allOf[0]->setFromRef('http://json-schema.org/draft-04/schema#/definitions/positiveInteger');
		$properties->minItems->allOf[1] = new Schema1();
		$properties->minItems->allOf[1]->default = 0;
		$properties->minItems->setFromRef('http://json-schema.org/draft-04/schema#/definitions/positiveIntegerDefault0');
		$properties->uniqueItems = Schema1::boolean();
		$properties->uniqueItems->default = false;
		$properties->uniqueItems->setFromRef('http://json-schema.org/draft-04/schema#/properties/uniqueItems');
		$properties->maxProperties = Schema1::integer();
		$properties->maxProperties->minimum = 0;
		$properties->maxProperties->setFromRef('http://json-schema.org/draft-04/schema#/definitions/positiveInteger');
		$properties->minProperties = new Schema1();
		$properties->minProperties->allOf[0] = Schema1::integer();
		$properties->minProperties->allOf[0]->minimum = 0;
		$properties->minProperties->allOf[0]->setFromRef('http://json-schema.org/draft-04/schema#/definitions/positiveInteger');
		$properties->minProperties->allOf[1] = new Schema1();
		$properties->minProperties->allOf[1]->default = 0;
		$properties->minProperties->setFromRef('http://json-schema.org/draft-04/schema#/definitions/positiveIntegerDefault0');
		$properties->required = Schema1::arr();
		$properties->required->items = Schema1::string();
		$properties->required->minItems = 1;
		$properties->required->uniqueItems = true;
		$properties->required->setFromRef('http://json-schema.org/draft-04/schema#/definitions/stringArray');
		$properties->enum = Schema1::arr();
		$properties->enum->minItems = 1;
		$properties->enum->uniqueItems = true;
		$properties->enum->setFromRef('http://json-schema.org/draft-04/schema#/properties/enum');
		$properties->additionalProperties = new Schema1();
		$properties->additionalProperties->anyOf[0] = Schema::schema();
		$properties->additionalProperties->anyOf[1] = Schema1::boolean();
		$properties->additionalProperties->default = (object)array (
		);
		$properties->type = new Schema1();
		$properties->type->anyOf[0] = new Schema1();
		$properties->type->anyOf[0]->enum = array(
		    self::_ARRAY,
		    self::BOOLEAN,
		    self::INTEGER,
		    self::NULL,
		    self::NUMBER,
		    self::OBJECT,
		    self::STRING,
		);
		$properties->type->anyOf[0]->setFromRef('#/definitions/simpleTypes');
		$properties->type->anyOf[1] = Schema1::arr();
		$properties->type->anyOf[1]->items = new Schema1();
		$properties->type->anyOf[1]->items->enum = array(
		    self::_ARRAY,
		    self::BOOLEAN,
		    self::INTEGER,
		    self::NULL,
		    self::NUMBER,
		    self::OBJECT,
		    self::STRING,
		);
		$properties->type->anyOf[1]->items->setFromRef('#/definitions/simpleTypes');
		$properties->type->anyOf[1]->minItems = 1;
		$properties->type->anyOf[1]->uniqueItems = true;
		$properties->type->setFromRef('http://json-schema.org/draft-04/schema#/properties/type');
		$properties->items = new Schema1();
		$properties->items->anyOf[0] = Schema::schema();
		$properties->items->anyOf[1] = Schema1::arr();
		$properties->items->anyOf[1]->items = Schema::schema();
		$properties->items->anyOf[1]->minItems = 1;
		$properties->items->default = (object)array (
		);
		$properties->allOf = Schema1::arr();
		$properties->allOf->items = Schema::schema();
		$properties->allOf->minItems = 1;
		$properties->properties = Schema1::object();
		$properties->properties->additionalProperties = Schema::schema();
		$properties->properties->default = (object)array (
		);
		$properties->discriminator = Schema1::string();
		$properties->readOnly = Schema1::boolean();
		$properties->readOnly->default = false;
		$properties->xml = Xml::schema();
		$properties->externalDocs = ExternalDocs::schema();
		$properties->example = new Schema1();
		$ownerSchema->type = 'object';
		$ownerSchema->additionalProperties = false;
		$patternProperty = new Schema1();
		$patternProperty->additionalProperties = true;
		$patternProperty->additionalItems = true;
		$patternProperty->description = "Any property starting with x- is valid.";
		$patternProperty->setFromRef('#/definitions/vendorExtension');
		$ownerSchema->setPatternProperty('^x-', $patternProperty);
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
	 * @param Schema|bool $additionalProperties
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
	 * @param Schema|Schema[]|array $items
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
	 * @param Schema[]|array $allOf
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
	 * @param Schema[] $properties
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
	public function setXml($xml)
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
	public function setExternalDocs($externalDocs)
	{
		$this->externalDocs = $externalDocs;
		return $this;
	}
	/** @codeCoverageIgnoreEnd */

	/**
	 * @param $example
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
	 * @return Schema1
	 */
	function exportSchema()
	{
		$schema = new Schema1();
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
		$schema->additionalProperties = $this->additionalProperties;
		$schema->type = $this->type;
		$schema->items = $this->items;
		$schema->allOf = $this->allOf;
		$schema->properties = $this->properties;
		$schema->__fromRef = $this->__fromRef;
		$schema->setDocumentPath($this->getDocumentPath());
		$schema->addMeta($this, 'origin');
		return $schema;
	}
}