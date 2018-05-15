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
 * Built from #/definitions/license
 * @method static License import($data, Context $options=null)
 */
class License extends ClassStructure {
	/** @var string The name of the license type. It's encouraged to use an OSI compatible license. */
	public $name;

	/** @var string The URL pointing to the license. */
	public $url;

	/**
	 * @param Properties|static $properties
	 * @param Schema $ownerSchema
	 */
	public static function setUpProperties($properties, Schema $ownerSchema)
	{
		$properties->name = Schema::string();
		$properties->name->description = "The name of the license type. It's encouraged to use an OSI compatible license.";
		$properties->url = Schema::string();
		$properties->url->description = "The URL pointing to the license.";
		$properties->url->format = "uri";
		$ownerSchema->type = 'object';
		$ownerSchema->additionalProperties = false;
		$patternProperty = new Schema();
		$patternProperty->additionalProperties = true;
		$patternProperty->additionalItems = true;
		$patternProperty->description = "Any property starting with x- is valid.";
		$patternProperty->setFromRef('#/definitions/vendorExtension');
		$ownerSchema->setPatternProperty('^x-', $patternProperty);
		$ownerSchema->required = array (
		  0 => 'name',
		);
		$ownerSchema->setFromRef('#/definitions/license');
	}

	/**
	 * @param string $name The name of the license type. It's encouraged to use an OSI compatible license.
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
	 * @param string $url The URL pointing to the license.
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