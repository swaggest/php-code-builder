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
 * @method static BodyParameter import($data, Context $options=null)
 */
class BodyParameter extends ClassStructure {
	const BODY = 'body';

	/** @var string A brief description of the parameter. This could contain examples of use.  GitHub Flavored Markdown is allowed. */
	public $description;

	/** @var string The name of the parameter. */
	public $name;

	/** @var string Determines the location of the parameter. */
	public $in;

	/** @var bool Determines whether or not this parameter is required or optional. */
	public $required;

	/** @var Schema A deterministic version of a JSON Schema object. */
	public $schema;

	/**
	 * @param Properties|static $properties
	 * @param Schema1 $ownerSchema
	 */
	public static function setUpProperties($properties, Schema1 $ownerSchema)
	{
		$properties->description = Schema1::string();
		$properties->description->description = "A brief description of the parameter. This could contain examples of use.  GitHub Flavored Markdown is allowed.";
		$properties->name = Schema1::string();
		$properties->name->description = "The name of the parameter.";
		$properties->in = Schema1::string();
		$properties->in->enum = array(
		    self::BODY,
		);
		$properties->in->description = "Determines the location of the parameter.";
		$properties->required = Schema1::boolean();
		$properties->required->description = "Determines whether or not this parameter is required or optional.";
		$properties->required->default = false;
		$properties->schema = Schema::schema();
		$ownerSchema->type = 'object';
		$ownerSchema->additionalProperties = false;
		$patternProperty = new Schema1();
		$patternProperty->description = "Any property starting with x- is valid.";
		$ownerSchema->patternProperties['^x-'] = $patternProperty;
		$ownerSchema->required = array (
		  0 => 'name',
		  1 => 'in',
		  2 => 'schema',
		);
	}

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
	 * @param Schema $schema A deterministic version of a JSON Schema object.
	 * @return $this
	 * @codeCoverageIgnoreStart
	 */
	public function setSchema($schema)
	{
		$this->schema = $schema;
		return $this;
	}
	/** @codeCoverageIgnoreEnd */
}