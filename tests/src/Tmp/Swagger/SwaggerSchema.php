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
 * A JSON Schema for Swagger 2.0 API.
 * @method static SwaggerSchema import($data, Context $options=null)
 */
class SwaggerSchema extends ClassStructure {
	const CONST_D1BD83 = '2.0';

	/** @var string The Swagger version of this document. */
	public $swagger;

	/** @var Info General information about the API. */
	public $info;

	/**
	 * @var string The
	 * host (name or ip) of the API. Example: 'swagger.io'
	 */
	public $host;

	/** @var string The base path to the API. Example: '/api'. */
	public $basePath;

	/** @var string[]|array The transfer protocol of the API. */
	public $schemes;

	/** @var string[]|array A list of MIME types accepted by the API. */
	public $consumes;

	/** @var string[]|array A list of MIME types the API can produce. */
	public $produces;

	/** @var PathItem[] Relative paths to the individual endpoints. They must be relative to the 'basePath'. */
	public $paths;

	/** @var DefinitionsSchema[] One or more JSON objects describing the schemas being consumed and produced by the API. */
	public $definitions;

	/** @var BodyParameter[]|HeaderParameterSubSchema[]|FormDataParameterSubSchema[]|QueryParameterSubSchema[]|PathParameterSubSchema[] One or more JSON representations for parameters */
	public $parameters;

	/** @var Response[] One or more JSON representations for parameters */
	public $responses;

	/** @var string[][]|array[][]|array */
	public $security;

	/** @var BasicAuthenticationSecurity[]|ApiKeySecurity[]|Oauth2ImplicitSecurity[]|Oauth2PasswordSecurity[]|Oauth2ApplicationSecurity[]|Oauth2AccessCodeSecurity[] */
	public $securityDefinitions;

	/** @var Tag[]|array */
	public $tags;

	/** @var ExternalDocs information about external documentation */
	public $externalDocs;

	/**
	 * @param Properties|static $properties
	 * @param Schema $ownerSchema
	 */
	public static function setUpProperties($properties, Schema $ownerSchema)
	{
		$properties->swagger = Schema::string();
		$properties->swagger->enum = array(
		    self::CONST_D1BD83,
		);
		$properties->swagger->description = "The Swagger version of this document.";
		$properties->info = Info::schema();
		$properties->host = Schema::string();
		$properties->host->description = "The\nhost (name or ip) of the API. Example: 'swagger.io'";
		$properties->host->pattern = "^[^{}/ :\\\\]+(?::\\d+)?$";
		$properties->basePath = Schema::string();
		$properties->basePath->description = "The base path to the API. Example: '/api'.";
		$properties->basePath->pattern = "^/";
		$properties->schemes = SchemesList::schema();
		$properties->consumes = new Schema();
		$properties->consumes->allOf[0] = MediaTypeList::schema();
		$properties->consumes->description = "A list of MIME types accepted by the API.";
		$properties->produces = new Schema();
		$properties->produces->allOf[0] = MediaTypeList::schema();
		$properties->produces->description = "A list of MIME types the API can produce.";
		$properties->paths = Paths::schema();
		$properties->definitions = Definitions::schema();
		$properties->parameters = ParameterDefinitions::schema();
		$properties->responses = ResponseDefinitions::schema();
		$properties->security = Security::schema();
		$properties->securityDefinitions = SecurityDefinitions::schema();
		$properties->tags = Schema::arr();
		$properties->tags->items = Tag::schema();
		$properties->tags->uniqueItems = true;
		$properties->externalDocs = ExternalDocs::schema();
		$ownerSchema->type = 'object';
		$ownerSchema->additionalProperties = false;
		$patternProperty = VendorExtension::schema();
		$ownerSchema->setPatternProperty('^x-', $patternProperty);
		$ownerSchema->id = "http://swagger.io/v2/schema.json#";
		$ownerSchema->schema = "http://json-schema.org/draft-04/schema#";
		$ownerSchema->title = "A JSON Schema for Swagger 2.0 API.";
		$ownerSchema->required = array (
		  0 => 'swagger',
		  1 => 'info',
		  2 => 'paths',
		);
	}

	/**
	 * @param string $swagger The Swagger version of this document.
	 * @return $this
	 * @codeCoverageIgnoreStart
	 */
	public function setSwagger($swagger)
	{
		$this->swagger = $swagger;
		return $this;
	}
	/** @codeCoverageIgnoreEnd */

	/**
	 * @param Info $info General information about the API.
	 * @return $this
	 * @codeCoverageIgnoreStart
	 */
	public function setInfo($info)
	{
		$this->info = $info;
		return $this;
	}
	/** @codeCoverageIgnoreEnd */

	/**
	 * @param string $host The
	 * host (name or ip) of the API. Example: 'swagger.io'
	 * @return $this
	 * @codeCoverageIgnoreStart
	 */
	public function setHost($host)
	{
		$this->host = $host;
		return $this;
	}
	/** @codeCoverageIgnoreEnd */

	/**
	 * @param string $basePath The base path to the API. Example: '/api'.
	 * @return $this
	 * @codeCoverageIgnoreStart
	 */
	public function setBasePath($basePath)
	{
		$this->basePath = $basePath;
		return $this;
	}
	/** @codeCoverageIgnoreEnd */

	/**
	 * @param string[]|array $schemes The transfer protocol of the API.
	 * @return $this
	 * @codeCoverageIgnoreStart
	 */
	public function setSchemes($schemes)
	{
		$this->schemes = $schemes;
		return $this;
	}
	/** @codeCoverageIgnoreEnd */

	/**
	 * @param string[]|array $consumes A list of MIME types accepted by the API.
	 * @return $this
	 * @codeCoverageIgnoreStart
	 */
	public function setConsumes($consumes)
	{
		$this->consumes = $consumes;
		return $this;
	}
	/** @codeCoverageIgnoreEnd */

	/**
	 * @param string[]|array $produces A list of MIME types the API can produce.
	 * @return $this
	 * @codeCoverageIgnoreStart
	 */
	public function setProduces($produces)
	{
		$this->produces = $produces;
		return $this;
	}
	/** @codeCoverageIgnoreEnd */

	/**
	 * @param PathItem[] $paths Relative paths to the individual endpoints. They must be relative to the 'basePath'.
	 * @return $this
	 * @codeCoverageIgnoreStart
	 */
	public function setPaths($paths)
	{
		$this->paths = $paths;
		return $this;
	}
	/** @codeCoverageIgnoreEnd */

	/**
	 * @param DefinitionsSchema[] $definitions One or more JSON objects describing the schemas being consumed and produced by the API.
	 * @return $this
	 * @codeCoverageIgnoreStart
	 */
	public function setDefinitions($definitions)
	{
		$this->definitions = $definitions;
		return $this;
	}
	/** @codeCoverageIgnoreEnd */

	/**
	 * @param BodyParameter[]|HeaderParameterSubSchema[]|FormDataParameterSubSchema[]|QueryParameterSubSchema[]|PathParameterSubSchema[] $parameters One or more JSON representations for parameters
	 * @return $this
	 * @codeCoverageIgnoreStart
	 */
	public function setParameters($parameters)
	{
		$this->parameters = $parameters;
		return $this;
	}
	/** @codeCoverageIgnoreEnd */

	/**
	 * @param Response[] $responses One or more JSON representations for parameters
	 * @return $this
	 * @codeCoverageIgnoreStart
	 */
	public function setResponses($responses)
	{
		$this->responses = $responses;
		return $this;
	}
	/** @codeCoverageIgnoreEnd */

	/**
	 * @param string[][]|array[][]|array $security
	 * @return $this
	 * @codeCoverageIgnoreStart
	 */
	public function setSecurity($security)
	{
		$this->security = $security;
		return $this;
	}
	/** @codeCoverageIgnoreEnd */

	/**
	 * @param BasicAuthenticationSecurity[]|ApiKeySecurity[]|Oauth2ImplicitSecurity[]|Oauth2PasswordSecurity[]|Oauth2ApplicationSecurity[]|Oauth2AccessCodeSecurity[] $securityDefinitions
	 * @return $this
	 * @codeCoverageIgnoreStart
	 */
	public function setSecurityDefinitions($securityDefinitions)
	{
		$this->securityDefinitions = $securityDefinitions;
		return $this;
	}
	/** @codeCoverageIgnoreEnd */

	/**
	 * @param Tag[]|array $tags
	 * @return $this
	 * @codeCoverageIgnoreStart
	 */
	public function setTags($tags)
	{
		$this->tags = $tags;
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
}