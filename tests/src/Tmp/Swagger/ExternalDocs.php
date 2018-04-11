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
 * @method static ExternalDocs import($data, Context $options=null)
 */
class ExternalDocs extends ClassStructure {
	/** @var string */
	public $description;

	/** @var string */
	public $url;

	/**
	 * @param Properties|static $properties
	 * @param Schema $ownerSchema
	 */
	public static function setUpProperties($properties, Schema $ownerSchema)
	{
		$properties->description = Schema::string();
		$properties->url = Schema::string();
		$properties->url->format = "uri";
		$ownerSchema->type = 'object';
		$ownerSchema->additionalProperties = false;
		$patternProperty = VendorExtension::schema();
		$ownerSchema->setPatternProperty('^x-', $patternProperty);
		$ownerSchema->description = "information about external documentation";
		$ownerSchema->required = array (
		  0 => 'url',
		);
		$ownerSchema->setFromRef('#/definitions/externalDocs');
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
	 * @param string $url
	 * @return $this
	 * @codeCoverageIgnoreStart
	 */
	public function setUrl($url)
	{
		$this->url = $url;
		return $this;
	}
	/** @codeCoverageIgnoreEnd */
}