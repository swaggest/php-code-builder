<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swaggest\PhpCodeBuilder\Tests\Tmp\SwaggerMin;

use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Exception\StringException;
use Swaggest\JsonSchema\Helper;
use Swaggest\JsonSchema\InvalidValue;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\Structure\ClassStructure;


/**
 * Built from #/definitions/operation
 */
class Operation extends ClassStructure
{
    const HTTP = 'http';

    const HTTPS = 'https';

    const WS = 'ws';

    const WSS = 'wss';

    const X_PROPERTY_PATTERN = '^x-';

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
        $propertiesProducesAllOf0 = Schema::arr();
        $propertiesProducesAllOf0->items = Schema::string();
        $propertiesProducesAllOf0->items->description = "The MIME type of the HTTP message.";
        $propertiesProducesAllOf0->items->setFromRef('#/definitions/mimeType');
        $propertiesProducesAllOf0->uniqueItems = true;
        $propertiesProducesAllOf0->setFromRef('#/definitions/mediaTypeList');
        $properties->produces->allOf[0] = $propertiesProducesAllOf0;
        $properties->produces->description = "A list of MIME types the API can produce.";
        $properties->consumes = new Schema();
        $propertiesConsumesAllOf0 = Schema::arr();
        $propertiesConsumesAllOf0->items = Schema::string();
        $propertiesConsumesAllOf0->items->description = "The MIME type of the HTTP message.";
        $propertiesConsumesAllOf0->items->setFromRef('#/definitions/mimeType');
        $propertiesConsumesAllOf0->uniqueItems = true;
        $propertiesConsumesAllOf0->setFromRef('#/definitions/mediaTypeList');
        $properties->consumes->allOf[0] = $propertiesConsumesAllOf0;
        $properties->consumes->description = "A list of MIME types the API can consume.";
        $properties->parameters = Schema::arr();
        $properties->parameters->additionalItems = false;
        $properties->parameters->items = new Schema();
        $propertiesParametersItemsOneOf0 = new Schema();
        $propertiesParametersItemsOneOf0->oneOf[0] = BodyParameter::schema();
        $propertiesParametersItemsOneOf0OneOf1 = Schema::object();
        $propertiesParametersItemsOneOf0OneOf1->oneOf[0] = HeaderParameterSubSchema::schema();
        $propertiesParametersItemsOneOf0OneOf1->oneOf[1] = FormDataParameterSubSchema::schema();
        $propertiesParametersItemsOneOf0OneOf1->oneOf[2] = QueryParameterSubSchema::schema();
        $propertiesParametersItemsOneOf0OneOf1->oneOf[3] = PathParameterSubSchema::schema();
        $propertiesParametersItemsOneOf0OneOf1->required = array(
            self::names()->name,
            self::names()->in,
            self::names()->type,
        );
        $propertiesParametersItemsOneOf0OneOf1->setFromRef('#/definitions/nonBodyParameter');
        $propertiesParametersItemsOneOf0->oneOf[1] = $propertiesParametersItemsOneOf0OneOf1;
        $propertiesParametersItemsOneOf0->setFromRef('#/definitions/parameter');
        $properties->parameters->items->oneOf[0] = $propertiesParametersItemsOneOf0;
        $properties->parameters->items->oneOf[1] = JsonReference::schema();
        $properties->parameters->description = "The parameters needed to send a valid API call.";
        $properties->parameters->uniqueItems = true;
        $properties->parameters->setFromRef('#/definitions/parametersList');
        $properties->responses = Schema::object();
        $properties->responses->additionalProperties = false;
        $patternProperty = new Schema();
        $patternProperty->oneOf[0] = Response::schema();
        $patternProperty->oneOf[1] = JsonReference::schema();
        $patternProperty->setFromRef('#/definitions/responseValue');
        $properties->responses->setPatternProperty('^([0-9]{3})$|^(default)$', $patternProperty);
        $patternProperty = new Schema();
        $patternProperty->additionalProperties = true;
        $patternProperty->additionalItems = true;
        $patternProperty->description = "Any property starting with x- is valid.";
        $patternProperty->setFromRef('#/definitions/vendorExtension');
        $properties->responses->setPatternProperty('^x-', $patternProperty);
        $properties->responses->not = Schema::object();
        $properties->responses->not->additionalProperties = false;
        $patternProperty = new Schema();
        $patternProperty->additionalProperties = true;
        $patternProperty->additionalItems = true;
        $patternProperty->description = "Any property starting with x- is valid.";
        $patternProperty->setFromRef('#/definitions/vendorExtension');
        $properties->responses->not->setPatternProperty('^x-', $patternProperty);
        $properties->responses->description = "Response objects names can either be any valid HTTP status code or 'default'.";
        $properties->responses->minProperties = 1;
        $properties->responses->setFromRef('#/definitions/responses');
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
        $properties->schemes->setFromRef('#/definitions/schemesList');
        $properties->deprecated = Schema::boolean();
        $properties->deprecated->default = false;
        $properties->security = Schema::arr();
        $properties->security->items = Schema::object();
        $properties->security->items->additionalProperties = Schema::arr();
        $properties->security->items->additionalProperties->items = Schema::string();
        $properties->security->items->additionalProperties->uniqueItems = true;
        $properties->security->items->setFromRef('#/definitions/securityRequirement');
        $properties->security->uniqueItems = true;
        $properties->security->setFromRef('#/definitions/security');
        $ownerSchema->type = 'object';
        $ownerSchema->additionalProperties = false;
        $patternProperty = new Schema();
        $patternProperty->additionalProperties = true;
        $patternProperty->additionalItems = true;
        $patternProperty->description = "Any property starting with x- is valid.";
        $patternProperty->setFromRef('#/definitions/vendorExtension');
        $ownerSchema->setPatternProperty('^x-', $patternProperty);
        $ownerSchema->required = array(
            self::names()->responses,
        );
        $ownerSchema->setFromRef('#/definitions/operation');
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
    public function setExternalDocs(ExternalDocs $externalDocs)
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

    /**
     * @codeCoverageIgnoreStart
     */
    public function getXValues()
    {
        $result = array();
        if (!$names = $this->getPatternPropertyNames(self::X_PROPERTY_PATTERN)) {
            return $result;
        }
        foreach ($names as $name) {
            $result[$name] = $this->$name;
        }
        return $result;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param string $name
     * @param mixed $value
     * @return self
     * @throws InvalidValue
     * @codeCoverageIgnoreStart
     */
    public function setXValue($name, $value)
    {
        if (preg_match(Helper::toPregPattern(self::X_PROPERTY_PATTERN), $name)) {
            throw new StringException('Pattern mismatch', StringException::PATTERN_MISMATCH);
        }
        $this->addPatternPropertyName(self::X_PROPERTY_PATTERN, $name);
        $this->{$name} = $value;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */
}