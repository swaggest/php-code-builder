<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swaggest\PhpCodeBuilder\Tests\Tmp\Swagger;

use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Context;
use Swaggest\JsonSchema\Schema as Schema1;
use Swaggest\JsonSchema\Structure\ClassStructure;


/**
 * @method static Response import($data, Context $options=null)
 */
class Response extends ClassStructure {
	/** @var string */
	public $description;

	/** @var Schema|FileSchema */
	public $schema;

	/** @var Header[] */
	public $headers;

	public $examples;

	/**
	 * @param Properties|static $properties
	 * @param Schema1 $ownerSchema
	 */
	public static function setUpProperties($properties, Schema1 $ownerSchema)
	{
		$properties->description = Schema1::string();
		$properties->schema = new Schema1();
		$properties->schema->oneOf[0] = Schema::schema();
		$properties->schema->oneOf[1] = FileSchema::schema();
		$properties->headers = Schema1::object();
		$properties->headers->additionalProperties = Header::schema();
		$properties->examples = Schema1::object();
		$ownerSchema->type = 'object';
		$ownerSchema->additionalProperties = false;
		$patternProperty = new Schema1();
		$patternProperty->description = "Any property starting with x- is valid.";
		$ownerSchema->patternProperties['^x-'] = $patternProperty;
		$ownerSchema->required = array (
		  0 => 'description',
		);
	}

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
	 * @param Schema|FileSchema $schema
	 * @return $this
	 * @codeCoverageIgnoreStart
	 */
	public function setSchema($schema)
	{
		$this->schema = $schema;
		return $this;
	}
	/** @codeCoverageIgnoreEnd */

	/**
	 * @param Header[] $headers
	 * @return $this
	 * @codeCoverageIgnoreStart
	 */
	public function setHeaders($headers)
	{
		$this->headers = $headers;
		return $this;
	}
	/** @codeCoverageIgnoreEnd */

	/**
	 * @param $examples
	 * @return $this
	 * @codeCoverageIgnoreStart
	 */
	public function setExamples($examples)
	{
		$this->examples = $examples;
		return $this;
	}
	/** @codeCoverageIgnoreEnd */
}