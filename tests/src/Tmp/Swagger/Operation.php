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
 * @method static Operation import($data, Context $options=null)
 */
class Operation extends ClassStructure {
	const HTTP = 'http';

	const HTTPS = 'https';

	const WS = 'ws';

	const WSS = 'wss';

	/** @var string[]|array */
	public $tags;

	/** @var string A brief summary of the operation. */
	public $summary;

	/** @var string A longer description of the operation, GitHub Flavored Markdown is allowed. */
	public $description;

	/** @var ExternalDocs information about external documentation */
	public $externalDocs;

	/** @var string A unique identifier of the operation. */
	public $operationId;

	/** @var string[]|array A list of MIME types the API can produce. */
	public $produces;

	/** @var string[]|array A list of MIME types the API can consume. */
	public $consumes;

	/** @var BodyParameter[]|HeaderParameterSubSchema[]|FormDataParameterSubSchema[]|QueryParameterSubSchema[]|PathParameterSubSchema[]|JsonReference[]|array The parameters needed to send a valid API call. */
	public $parameters;

	/** @var Response[]|JsonReference[] Response objects names can either be any valid HTTP status code or 'default'. */
	public $responses;

	/** @var string[]|array The transfer protocol of the API. */
	public $schemes;

	/** @var bool */
	public $deprecated;

	/** @var string[][]|array[][]|array */
	public $security;

	/**
	 * @param Properties|static $properties
	 * @param Schema $ownerSchema
	 */
	public static function setUpProperties($properties, Schema $ownerSchema)
	{
		$properties->tags = Schema::arr();
		$properties->tags->items = Schema::string();
		$properties->tags->uniqueItems = true;
		$properties->summary = Schema::string();
		$properties->summary->description = "A brief summary of the operation.";
		$properties->description = Schema::string();
		$properties->description->description = "A longer description of the operation, GitHub Flavored Markdown is allowed.";
		$properties->externalDocs = ExternalDocs::schema();
		$properties->operationId = Schema::string();
		$properties->operationId->description = "A unique identifier of the operation.";
		$properties->produces = new Schema();
		$properties->produces->allOf[0] = Schema::arr();
		$properties->produces->allOf[0]->items = Schema::string();
		$properties->produces->allOf[0]->items->description = "The MIME type of the HTTP message.";
		$properties->produces->allOf[0]->uniqueItems = true;
		$properties->produces->description = "A list of MIME types the API can produce.";
		$properties->consumes = new Schema();
		$properties->consumes->allOf[0] = Schema::arr();
		$properties->consumes->allOf[0]->items = Schema::string();
		$properties->consumes->allOf[0]->items->description = "The MIME type of the HTTP message.";
		$properties->consumes->allOf[0]->uniqueItems = true;
		$properties->consumes->description = "A list of MIME types the API can consume.";
		$properties->parameters = Schema::arr();
		$properties->parameters->items = new Schema();
		$properties->parameters->items->oneOf[0] = new Schema();
		$properties->parameters->items->oneOf[0]->oneOf[0] = BodyParameter::schema();
		$properties->parameters->items->oneOf[0]->oneOf[1] = Schema::object();
		$properties->parameters->items->oneOf[0]->oneOf[1]->oneOf[0] = HeaderParameterSubSchema::schema();
		$properties->parameters->items->oneOf[0]->oneOf[1]->oneOf[1] = FormDataParameterSubSchema::schema();
		$properties->parameters->items->oneOf[0]->oneOf[1]->oneOf[2] = QueryParameterSubSchema::schema();
		$properties->parameters->items->oneOf[0]->oneOf[1]->oneOf[3] = PathParameterSubSchema::schema();
		$properties->parameters->items->oneOf[0]->oneOf[1]->required = array (
		  0 => 'name',
		  1 => 'in',
		  2 => 'type',
		);
		$properties->parameters->items->oneOf[1] = JsonReference::schema();
		$properties->parameters->description = "The parameters needed to send a valid API call.";
		$properties->parameters->uniqueItems = true;
		$properties->responses = Schema::object();
		$properties->responses->additionalProperties = false;
		$patternProperty = new Schema();
		$patternProperty->oneOf[0] = Response::schema();
		$patternProperty->oneOf[1] = JsonReference::schema();
		$properties->responses->patternProperties['^([0-9]{3})$|^(default)$'] = $patternProperty;
		$patternProperty = new Schema();
		$patternProperty->description = "Any property starting with x- is valid.";
		$properties->responses->patternProperties['^x-'] = $patternProperty;
		$properties->responses->not = Schema::object();
		$properties->responses->not->additionalProperties = false;
		$patternProperty = new Schema();
		$patternProperty->description = "Any property starting with x- is valid.";
		$properties->responses->not->patternProperties['^x-'] = $patternProperty;
		$properties->responses->description = "Response objects names can either be any valid HTTP status code or \'default\'.";
		$properties->responses->minProperties = 1;
		$properties->schemes = Schema::arr();
		$properties->schemes->items = Schema::string();
		$properties->schemes->items->enum = array(
		    self::HTTP,
		    self::HTTPS,
		    self::WS,
		    self::WSS,
		);
		$properties->schemes->description = "The transfer protocol of the API.";
		$properties->schemes->uniqueItems = true;
		$properties->deprecated = Schema::boolean();
		$properties->deprecated->default = false;
		$properties->security = Schema::arr();
		$properties->security->items = Schema::object();
		$properties->security->items->additionalProperties = Schema::arr();
		$properties->security->items->additionalProperties->items = Schema::string();
		$properties->security->items->additionalProperties->uniqueItems = true;
		$properties->security->uniqueItems = true;
		$ownerSchema->type = 'object';
		$ownerSchema->additionalProperties = false;
		$patternProperty = new Schema();
		$patternProperty->description = "Any property starting with x- is valid.";
		$ownerSchema->patternProperties['^x-'] = $patternProperty;
		$ownerSchema->required = array (
		  0 => 'responses',
		);
	}

	/**
	 * @param string[]|array $tags
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
	 * @param string $summary A brief summary of the operation.
	 * @return $this
	 * @codeCoverageIgnoreStart
	 */
	public function setSummary($summary)
	{
		$this->summary = $summary;
		return $this;
	}
	/** @codeCoverageIgnoreEnd */

	/**
	 * @param string $description A longer description of the operation, GitHub Flavored Markdown is allowed.
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

	/**
	 * @param string $operationId A unique identifier of the operation.
	 * @return $this
	 * @codeCoverageIgnoreStart
	 */
	public function setOperationId($operationId)
	{
		$this->operationId = $operationId;
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
	 * @param string[]|array $consumes A list of MIME types the API can consume.
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

	/**
	 * @param Response[]|JsonReference[] $responses Response objects names can either be any valid HTTP status code or 'default'.
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
	 * @param bool $deprecated
	 * @return $this
	 * @codeCoverageIgnoreStart
	 */
	public function setDeprecated($deprecated)
	{
		$this->deprecated = $deprecated;
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
}