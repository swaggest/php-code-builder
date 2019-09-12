<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swaggest\PhpCodeBuilder\Tests\Tmp\OpenAPI3;

use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Exception\StringException;
use Swaggest\JsonSchema\Helper;
use Swaggest\JsonSchema\InvalidValue;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\Structure\ClassStructure;


/**
 * Built from #/definitions/Operation
 */
class Operation extends ClassStructure
{
    const X_PROPERTY_PATTERN = '^x-';

    /** @var string[]|array */
    public $tags;

    /** @var string */
    public $summary;

    /** @var string */
    public $description;

    /** @var ExternalDocumentation */
    public $externalDocs;

    /** @var string */
    public $operationId;

    /** @var Parameter[]|mixed[]|ParameterLocationParameterInPath[]|ParameterLocationParameterInQuery[]|ParameterLocationParameterInHeader[]|ParameterLocationParameterInCookie[]|string[][]|array */
    public $parameters;

    /** @var RequestBody|string[] */
    public $requestBody;

    /** @var Responses|Response[]|string[][] */
    public $responses;

    /** @var PathItem[]|Operation[][][]|string[][] */
    public $callbacks;

    /** @var bool */
    public $deprecated;

    /** @var string[][]|array[][]|array */
    public $security;

    /** @var Server[]|array */
    public $servers;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->tags = Schema::arr();
        $properties->tags->items = Schema::string();
        $properties->summary = Schema::string();
        $properties->description = Schema::string();
        $properties->externalDocs = ExternalDocumentation::schema();
        $properties->operationId = Schema::string();
        $properties->parameters = Schema::arr();
        $properties->parameters->items = new Schema();
        $properties->parameters->items->oneOf[0] = Parameter::schema();
        $propertiesParametersItemsOneOf1 = Schema::object();
        $ref = Schema::string();
        $ref->format = "uri-reference";
        $propertiesParametersItemsOneOf1->setPatternProperty('^\\$ref$', $ref);
        $propertiesParametersItemsOneOf1->not = new Schema();
        $propertiesParametersItemsOneOf1->not->description = "References are removed from validation because of proactive dereferencing";
        $propertiesParametersItemsOneOf1->required = array(
            '$ref',
        );
        $propertiesParametersItemsOneOf1->setFromRef('#/definitions/Reference');
        $properties->parameters->items->oneOf[1] = $propertiesParametersItemsOneOf1;
        $properties->parameters->uniqueItems = true;
        $properties->requestBody = new Schema();
        $properties->requestBody->oneOf[0] = RequestBody::schema();
        $propertiesRequestBodyOneOf1 = Schema::object();
        $ref = Schema::string();
        $ref->format = "uri-reference";
        $propertiesRequestBodyOneOf1->setPatternProperty('^\\$ref$', $ref);
        $propertiesRequestBodyOneOf1->not = new Schema();
        $propertiesRequestBodyOneOf1->not->description = "References are removed from validation because of proactive dereferencing";
        $propertiesRequestBodyOneOf1->required = array(
            '$ref',
        );
        $propertiesRequestBodyOneOf1->setFromRef('#/definitions/Reference');
        $properties->requestBody->oneOf[1] = $propertiesRequestBodyOneOf1;
        $properties->responses = Responses::schema();
        $properties->callbacks = Schema::object();
        $properties->callbacks->additionalProperties = new Schema();
        $propertiesCallbacksAdditionalPropertiesOneOf0 = Schema::object();
        $propertiesCallbacksAdditionalPropertiesOneOf0->additionalProperties = PathItem::schema();
        $x = new Schema();
        $propertiesCallbacksAdditionalPropertiesOneOf0->setPatternProperty('^x-', $x);
        $propertiesCallbacksAdditionalPropertiesOneOf0->setFromRef('#/definitions/Callback');
        $properties->callbacks->additionalProperties->oneOf[0] = $propertiesCallbacksAdditionalPropertiesOneOf0;
        $propertiesCallbacksAdditionalPropertiesOneOf1 = Schema::object();
        $ref = Schema::string();
        $ref->format = "uri-reference";
        $propertiesCallbacksAdditionalPropertiesOneOf1->setPatternProperty('^\\$ref$', $ref);
        $propertiesCallbacksAdditionalPropertiesOneOf1->not = new Schema();
        $propertiesCallbacksAdditionalPropertiesOneOf1->not->description = "References are removed from validation because of proactive dereferencing";
        $propertiesCallbacksAdditionalPropertiesOneOf1->required = array(
            '$ref',
        );
        $propertiesCallbacksAdditionalPropertiesOneOf1->setFromRef('#/definitions/Reference');
        $properties->callbacks->additionalProperties->oneOf[1] = $propertiesCallbacksAdditionalPropertiesOneOf1;
        $properties->deprecated = Schema::boolean();
        $properties->deprecated->default = false;
        $properties->security = Schema::arr();
        $properties->security->items = Schema::object();
        $properties->security->items->additionalProperties = Schema::arr();
        $properties->security->items->additionalProperties->items = Schema::string();
        $properties->security->items->setFromRef('#/definitions/SecurityRequirement');
        $properties->servers = Schema::arr();
        $properties->servers->items = Server::schema();
        $ownerSchema->type = 'object';
        $ownerSchema->additionalProperties = false;
        $x = new Schema();
        $ownerSchema->setPatternProperty('^x-', $x);
        $ownerSchema->required = array(
            self::names()->responses,
        );
        $ownerSchema->setFromRef('#/definitions/Operation');
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
     * @param string $summary
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
     * @param ExternalDocumentation $externalDocs
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setExternalDocs(ExternalDocumentation $externalDocs)
    {
        $this->externalDocs = $externalDocs;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param string $operationId
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
     * @param Parameter[]|mixed[]|ParameterLocationParameterInPath[]|ParameterLocationParameterInQuery[]|ParameterLocationParameterInHeader[]|ParameterLocationParameterInCookie[]|string[][]|array $parameters
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
     * @param RequestBody|string[] $requestBody
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setRequestBody($requestBody)
    {
        $this->requestBody = $requestBody;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param Responses|Response[]|string[][] $responses
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
     * @param PathItem[]|Operation[][][]|string[][] $callbacks
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setCallbacks($callbacks)
    {
        $this->callbacks = $callbacks;
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
     * @param Server[]|array $servers
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setServers($servers)
    {
        $this->servers = $servers;
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