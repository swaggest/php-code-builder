<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swaggest\PhpCodeBuilder\Tests\Tmp\SwaggerMin;

use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Context;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\Structure\ClassStructure;


/**
 * Built from #/definitions/response
 * @method static Response import($data, Context $options=null)
 */
class Response extends ClassStructure {
	/** @var string */
	public $description;

	/** @var DefinitionsSchema|FileSchema */
	public $schema;

	/** @var Header[] */
	public $headers;

	public $examples;

	/**
	 * @param Properties|static $properties
	 * @param Schema $ownerSchema
	 */
	public static function setUpProperties($properties, Schema $ownerSchema)
	{
		$properties->description = Schema::string();
		$properties->schema = new Schema();
		$properties->schema->oneOf[0] = DefinitionsSchema::schema();
		$properties->schema->oneOf[1] = FileSchema::schema();
		$properties->headers = Schema::object();
		$properties->headers->additionalProperties = Header::schema();
		$properties->headers->setFromRef('#/definitions/headers');
		$properties->examples = Schema::object();
		$properties->examples->additionalProperties = true;
		$properties->examples->setFromRef('#/definitions/examples');
		$ownerSchema->type = 'object';
		$ownerSchema->additionalProperties = false;
		$patternProperty = new Schema();
		$patternProperty->additionalProperties = true;
		$patternProperty->additionalItems = true;
		$patternProperty->description = "Any property starting with x- is valid.";
		$patternProperty->setFromRef('#/definitions/vendorExtension');
		$ownerSchema->setPatternProperty('^x-', $patternProperty);
		$ownerSchema->required = array (
		  0 => 'description',
		);
		$ownerSchema->setFromRef('#/definitions/response');
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
	 * @param DefinitionsSchema|FileSchema $schema
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