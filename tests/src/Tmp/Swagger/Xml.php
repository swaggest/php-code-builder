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
 * @method static Xml import($data, Context $options=null)
 */
class Xml extends ClassStructure {
	/** @var string */
	public $name;

	/** @var string */
	public $namespace;

	/** @var string */
	public $prefix;

	/** @var bool */
	public $attribute;

	/** @var bool */
	public $wrapped;

	/**
	 * @param Properties|static $properties
	 * @param Schema $ownerSchema
	 */
	public static function setUpProperties($properties, Schema $ownerSchema)
	{
		$properties->name = Schema::string();
		$properties->namespace = Schema::string();
		$properties->prefix = Schema::string();
		$properties->attribute = Schema::boolean();
		$properties->attribute->default = false;
		$properties->wrapped = Schema::boolean();
		$properties->wrapped->default = false;
		$ownerSchema->type = 'object';
		$ownerSchema->additionalProperties = false;
		$patternProperty = VendorExtension::schema();
		$ownerSchema->setPatternProperty('^x-', $patternProperty);
		$ownerSchema->setFromRef('#/definitions/xml');
	}

	/**
	 * @param string $name
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
	 * @param string $namespace
	 * @return $this
	 * @codeCoverageIgnoreStart
	 */
	public function setNamespace($namespace)
	{
		$this->namespace = $namespace;
		return $this;
	}
	/** @codeCoverageIgnoreEnd */

	/**
	 * @param string $prefix
	 * @return $this
	 * @codeCoverageIgnoreStart
	 */
	public function setPrefix($prefix)
	{
		$this->prefix = $prefix;
		return $this;
	}
	/** @codeCoverageIgnoreEnd */

	/**
	 * @param bool $attribute
	 * @return $this
	 * @codeCoverageIgnoreStart
	 */
	public function setAttribute($attribute)
	{
		$this->attribute = $attribute;
		return $this;
	}
	/** @codeCoverageIgnoreEnd */

	/**
	 * @param bool $wrapped
	 * @return $this
	 * @codeCoverageIgnoreStart
	 */
	public function setWrapped($wrapped)
	{
		$this->wrapped = $wrapped;
		return $this;
	}
	/** @codeCoverageIgnoreEnd */
}