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
 * Built from #/definitions/pathItem
 * @method static PathItem import($data, Context $options=null)
 */
class PathItem extends ClassStructure {
	/** @var string */
	public $ref;

	/** @var Operation */
	public $get;

	/** @var Operation */
	public $put;

	/** @var Operation */
	public $post;

	/** @var Operation */
	public $delete;

	/** @var Operation */
	public $options;

	/** @var Operation */
	public $head;

	/** @var Operation */
	public $patch;

	/** @var BodyParameter[]|HeaderParameterSubSchema[]|FormDataParameterSubSchema[]|QueryParameterSubSchema[]|PathParameterSubSchema[]|JsonReference[]|array The parameters needed to send a valid API call. */
	public $parameters;

	/**
	 * @param Properties|static $properties
	 * @param Schema $ownerSchema
	 */
	public static function setUpProperties($properties, Schema $ownerSchema)
	{
		$properties->ref = Schema::string();
		$ownerSchema->addPropertyMapping('$ref', self::names()->ref);
		$properties->get = Operation::schema();
		$properties->put = Operation::schema();
		$properties->post = Operation::schema();
		$properties->delete = Operation::schema();
		$properties->options = Operation::schema();
		$properties->head = Operation::schema();
		$properties->patch = Operation::schema();
		$properties->parameters = ParametersList::schema();
		$ownerSchema->type = 'object';
		$ownerSchema->additionalProperties = false;
		$patternProperty = VendorExtension::schema();
		$ownerSchema->setPatternProperty('^x-', $patternProperty);
		$ownerSchema->setFromRef('#/definitions/pathItem');
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
	 * @param Operation $get
	 * @return $this
	 * @codeCoverageIgnoreStart
	 */
	public function setGet($get)
	{
		$this->get = $get;
		return $this;
	}
	/** @codeCoverageIgnoreEnd */

	/**
	 * @param Operation $put
	 * @return $this
	 * @codeCoverageIgnoreStart
	 */
	public function setPut($put)
	{
		$this->put = $put;
		return $this;
	}
	/** @codeCoverageIgnoreEnd */

	/**
	 * @param Operation $post
	 * @return $this
	 * @codeCoverageIgnoreStart
	 */
	public function setPost($post)
	{
		$this->post = $post;
		return $this;
	}
	/** @codeCoverageIgnoreEnd */

	/**
	 * @param Operation $delete
	 * @return $this
	 * @codeCoverageIgnoreStart
	 */
	public function setDelete($delete)
	{
		$this->delete = $delete;
		return $this;
	}
	/** @codeCoverageIgnoreEnd */

	/**
	 * @param Operation $options
	 * @return $this
	 * @codeCoverageIgnoreStart
	 */
	public function setOptions($options)
	{
		$this->options = $options;
		return $this;
	}
	/** @codeCoverageIgnoreEnd */

	/**
	 * @param Operation $head
	 * @return $this
	 * @codeCoverageIgnoreStart
	 */
	public function setHead($head)
	{
		$this->head = $head;
		return $this;
	}
	/** @codeCoverageIgnoreEnd */

	/**
	 * @param Operation $patch
	 * @return $this
	 * @codeCoverageIgnoreStart
	 */
	public function setPatch($patch)
	{
		$this->patch = $patch;
		return $this;
	}
	/** @codeCoverageIgnoreEnd */

	/**
	 * @param BodyParameter[]|HeaderParameterSubSchema[]|FormDataParameterSubSchema[]|QueryParameterSubSchema[]|PathParameterSubSchema[]|JsonReference[]|array $parameters The parameters needed to send a valid API call.
	 * @return $this
	 * @codeCoverageIgnoreStart
	 */
	public function setParameters($parameters)
	{
		$this->parameters = $parameters;
		return $this;
	}
	/** @codeCoverageIgnoreEnd */
}