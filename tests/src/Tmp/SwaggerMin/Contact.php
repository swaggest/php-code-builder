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
 * Contact information for the owners of the API.
 * Built from #/definitions/contact
 * @method static Contact import($data, Context $options=null)
 */
class Contact extends ClassStructure {
	/** @var string The identifying name of the contact person/organization. */
	public $name;

	/** @var string The URL pointing to the contact information. */
	public $url;

	/** @var string The email address of the contact person/organization. */
	public $email;

	/**
	 * @param Properties|static $properties
	 * @param Schema $ownerSchema
	 */
	public static function setUpProperties($properties, Schema $ownerSchema)
	{
		$properties->name = Schema::string();
		$properties->name->description = "The identifying name of the contact person/organization.";
		$properties->url = Schema::string();
		$properties->url->description = "The URL pointing to the contact information.";
		$properties->url->format = "uri";
		$properties->email = Schema::string();
		$properties->email->description = "The email address of the contact person/organization.";
		$properties->email->format = "email";
		$ownerSchema->type = 'object';
		$ownerSchema->additionalProperties = false;
		$patternProperty = new Schema();
		$patternProperty->additionalProperties = true;
		$patternProperty->additionalItems = true;
		$patternProperty->description = "Any property starting with x- is valid.";
		$patternProperty->setFromRef('#/definitions/vendorExtension');
		$ownerSchema->setPatternProperty('^x-', $patternProperty);
		$ownerSchema->description = "Contact information for the owners of the API.";
		$ownerSchema->setFromRef('#/definitions/contact');
	}

	/**
	 * @param string $name The identifying name of the contact person/organization.
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
	 * @param string $url The URL pointing to the contact information.
	 * @return $this
	 * @codeCoverageIgnoreStart
	 */
	public function setUrl($url)
	{
		$this->url = $url;
		return $this;
	}
	/** @codeCoverageIgnoreEnd */

	/**
	 * @param string $email The email address of the contact person/organization.
	 * @return $this
	 * @codeCoverageIgnoreStart
	 */
	public function setEmail($email)
	{
		$this->email = $email;
		return $this;
	}
	/** @codeCoverageIgnoreEnd */
}