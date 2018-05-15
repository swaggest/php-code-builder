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
 * Built from #/definitions/oauth2ImplicitSecurity
 * @method static Oauth2ImplicitSecurity import($data, Context $options=null)
 */
class Oauth2ImplicitSecurity extends ClassStructure {
	const OAUTH2 = 'oauth2';

	const IMPLICIT = 'implicit';

	/** @var string */
	public $type;

	/** @var string */
	public $flow;

	/** @var string[] */
	public $scopes;

	/** @var string */
	public $authorizationUrl;

	/** @var string */
	public $description;

	/**
	 * @param Properties|static $properties
	 * @param Schema $ownerSchema
	 */
	public static function setUpProperties($properties, Schema $ownerSchema)
	{
		$properties->type = Schema::string();
		$properties->type->enum = array(
		    self::OAUTH2,
		);
		$properties->flow = Schema::string();
		$properties->flow->enum = array(
		    self::IMPLICIT,
		);
		$properties->scopes = Oauth2Scopes::schema();
		$properties->authorizationUrl = Schema::string();
		$properties->authorizationUrl->format = "uri";
		$properties->description = Schema::string();
		$ownerSchema->type = 'object';
		$ownerSchema->additionalProperties = false;
		$patternProperty = VendorExtension::schema();
		$ownerSchema->setPatternProperty('^x-', $patternProperty);
		$ownerSchema->required = array (
		  0 => 'type',
		  1 => 'flow',
		  2 => 'authorizationUrl',
		);
		$ownerSchema->setFromRef('#/definitions/oauth2ImplicitSecurity');
	}

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
	 * @param string $flow
	 * @return $this
	 * @codeCoverageIgnoreStart
	 */
	public function setFlow($flow)
	{
		$this->flow = $flow;
		return $this;
	}
	/** @codeCoverageIgnoreEnd */

	/**
	 * @param string[] $scopes
	 * @return $this
	 * @codeCoverageIgnoreStart
	 */
	public function setScopes($scopes)
	{
		$this->scopes = $scopes;
		return $this;
	}
	/** @codeCoverageIgnoreEnd */

	/**
	 * @param string $authorizationUrl
	 * @return $this
	 * @codeCoverageIgnoreStart
	 */
	public function setAuthorizationUrl($authorizationUrl)
	{
		$this->authorizationUrl = $authorizationUrl;
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
}