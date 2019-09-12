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
 * Built from #/definitions/Components
 */
class Components extends ClassStructure
{
    const X_PROPERTY_PATTERN = '^x-';

    /** @var DefinitionsSchema[]|string[][] */
    public $schemas;

    /** @var string[][]|Response[] */
    public $responses;

    /** @var string[][]|Parameter[]|mixed[]|ParameterLocationParameterInPath[]|ParameterLocationParameterInQuery[]|ParameterLocationParameterInHeader[]|ParameterLocationParameterInCookie[] */
    public $parameters;

    /** @var string[][]|Example[] */
    public $examples;

    /** @var string[][]|RequestBody[] */
    public $requestBodies;

    /** @var string[][]|Header[]|mixed[] */
    public $headers;

    /** @var string[][]|APIKeySecurityScheme[]|HTTPSecurityScheme[]|HTTPSecuritySchemeBearer[]|HTTPSecuritySchemeNonBearer[]|OAuth2SecurityScheme[]|OpenIdConnectSecurityScheme[] */
    public $securitySchemes;

    /** @var string[][]|Link[] */
    public $links;

    /** @var string[][]|PathItem[]|Operation[][][] */
    public $callbacks;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->schemas = Schema::object();
        $patternProperty = new Schema();
        $patternProperty->oneOf[0] = DefinitionsSchema::schema();
        $patternPropertyOneOf1 = Schema::object();
        $patternProperty = Schema::string();
        $patternProperty->format = "uri-reference";
        $patternPropertyOneOf1->setPatternProperty('^\\$ref$', $patternProperty);
        $patternPropertyOneOf1->required = array(
            '$ref',
        );
        $patternPropertyOneOf1->setFromRef('#/definitions/Reference');
        $patternProperty->oneOf[1] = $patternPropertyOneOf1;
        $properties->schemas->setPatternProperty('^[a-zA-Z0-9\\.\\-_]+$', $patternProperty);
        $properties->responses = Schema::object();
        $patternProperty = new Schema();
        $patternPropertyOneOf0 = Schema::object();
        $patternProperty = Schema::string();
        $patternProperty->format = "uri-reference";
        $patternPropertyOneOf0->setPatternProperty('^\\$ref$', $patternProperty);
        $patternPropertyOneOf0->required = array(
            '$ref',
        );
        $patternPropertyOneOf0->setFromRef('#/definitions/Reference');
        $patternProperty->oneOf[0] = $patternPropertyOneOf0;
        $patternProperty->oneOf[1] = Response::schema();
        $properties->responses->setPatternProperty('^[a-zA-Z0-9\\.\\-_]+$', $patternProperty);
        $properties->parameters = Schema::object();
        $patternProperty = new Schema();
        $patternPropertyOneOf0 = Schema::object();
        $patternProperty = Schema::string();
        $patternProperty->format = "uri-reference";
        $patternPropertyOneOf0->setPatternProperty('^\\$ref$', $patternProperty);
        $patternPropertyOneOf0->required = array(
            '$ref',
        );
        $patternPropertyOneOf0->setFromRef('#/definitions/Reference');
        $patternProperty->oneOf[0] = $patternPropertyOneOf0;
        $patternProperty->oneOf[1] = Parameter::schema();
        $properties->parameters->setPatternProperty('^[a-zA-Z0-9\\.\\-_]+$', $patternProperty);
        $properties->examples = Schema::object();
        $patternProperty = new Schema();
        $patternPropertyOneOf0 = Schema::object();
        $patternProperty = Schema::string();
        $patternProperty->format = "uri-reference";
        $patternPropertyOneOf0->setPatternProperty('^\\$ref$', $patternProperty);
        $patternPropertyOneOf0->required = array(
            '$ref',
        );
        $patternPropertyOneOf0->setFromRef('#/definitions/Reference');
        $patternProperty->oneOf[0] = $patternPropertyOneOf0;
        $patternProperty->oneOf[1] = Example::schema();
        $properties->examples->setPatternProperty('^[a-zA-Z0-9\\.\\-_]+$', $patternProperty);
        $properties->requestBodies = Schema::object();
        $patternProperty = new Schema();
        $patternPropertyOneOf0 = Schema::object();
        $patternProperty = Schema::string();
        $patternProperty->format = "uri-reference";
        $patternPropertyOneOf0->setPatternProperty('^\\$ref$', $patternProperty);
        $patternPropertyOneOf0->required = array(
            '$ref',
        );
        $patternPropertyOneOf0->setFromRef('#/definitions/Reference');
        $patternProperty->oneOf[0] = $patternPropertyOneOf0;
        $patternProperty->oneOf[1] = RequestBody::schema();
        $properties->requestBodies->setPatternProperty('^[a-zA-Z0-9\\.\\-_]+$', $patternProperty);
        $properties->headers = Schema::object();
        $patternProperty = new Schema();
        $patternPropertyOneOf0 = Schema::object();
        $patternProperty = Schema::string();
        $patternProperty->format = "uri-reference";
        $patternPropertyOneOf0->setPatternProperty('^\\$ref$', $patternProperty);
        $patternPropertyOneOf0->required = array(
            '$ref',
        );
        $patternPropertyOneOf0->setFromRef('#/definitions/Reference');
        $patternProperty->oneOf[0] = $patternPropertyOneOf0;
        $patternProperty->oneOf[1] = Header::schema();
        $properties->headers->setPatternProperty('^[a-zA-Z0-9\\.\\-_]+$', $patternProperty);
        $properties->securitySchemes = Schema::object();
        $patternProperty = new Schema();
        $patternPropertyOneOf0 = Schema::object();
        $patternProperty = Schema::string();
        $patternProperty->format = "uri-reference";
        $patternPropertyOneOf0->setPatternProperty('^\\$ref$', $patternProperty);
        $patternPropertyOneOf0->required = array(
            '$ref',
        );
        $patternPropertyOneOf0->setFromRef('#/definitions/Reference');
        $patternProperty->oneOf[0] = $patternPropertyOneOf0;
        $patternPropertyOneOf1 = new Schema();
        $patternPropertyOneOf1->oneOf[0] = APIKeySecurityScheme::schema();
        $patternPropertyOneOf1->oneOf[1] = HTTPSecurityScheme::schema();
        $patternPropertyOneOf1->oneOf[2] = OAuth2SecurityScheme::schema();
        $patternPropertyOneOf1->oneOf[3] = OpenIdConnectSecurityScheme::schema();
        $patternPropertyOneOf1->setFromRef('#/definitions/SecurityScheme');
        $patternProperty->oneOf[1] = $patternPropertyOneOf1;
        $properties->securitySchemes->setPatternProperty('^[a-zA-Z0-9\\.\\-_]+$', $patternProperty);
        $properties->links = Schema::object();
        $patternProperty = new Schema();
        $patternPropertyOneOf0 = Schema::object();
        $patternProperty = Schema::string();
        $patternProperty->format = "uri-reference";
        $patternPropertyOneOf0->setPatternProperty('^\\$ref$', $patternProperty);
        $patternPropertyOneOf0->required = array(
            '$ref',
        );
        $patternPropertyOneOf0->setFromRef('#/definitions/Reference');
        $patternProperty->oneOf[0] = $patternPropertyOneOf0;
        $patternProperty->oneOf[1] = Link::schema();
        $properties->links->setPatternProperty('^[a-zA-Z0-9\\.\\-_]+$', $patternProperty);
        $properties->callbacks = Schema::object();
        $patternProperty = new Schema();
        $patternPropertyOneOf0 = Schema::object();
        $patternProperty = Schema::string();
        $patternProperty->format = "uri-reference";
        $patternPropertyOneOf0->setPatternProperty('^\\$ref$', $patternProperty);
        $patternPropertyOneOf0->required = array(
            '$ref',
        );
        $patternPropertyOneOf0->setFromRef('#/definitions/Reference');
        $patternProperty->oneOf[0] = $patternPropertyOneOf0;
        $patternPropertyOneOf1 = Schema::object();
        $patternPropertyOneOf1->additionalProperties = PathItem::schema();
        $patternProperty = new Schema();
        $patternPropertyOneOf1->setPatternProperty('^x-', $patternProperty);
        $patternPropertyOneOf1->setFromRef('#/definitions/Callback');
        $patternProperty->oneOf[1] = $patternPropertyOneOf1;
        $properties->callbacks->setPatternProperty('^[a-zA-Z0-9\\.\\-_]+$', $patternProperty);
        $ownerSchema->type = 'object';
        $ownerSchema->additionalProperties = false;
        $patternProperty = new Schema();
        $ownerSchema->setPatternProperty('^x-', $patternProperty);
        $ownerSchema->setFromRef('#/definitions/Components');
    }

    /**
     * @param DefinitionsSchema[]|string[][] $schemas
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setSchemas($schemas)
    {
        $this->schemas = $schemas;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param string[][]|Response[] $responses
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
     * @param string[][]|Parameter[]|mixed[]|ParameterLocationParameterInPath[]|ParameterLocationParameterInQuery[]|ParameterLocationParameterInHeader[]|ParameterLocationParameterInCookie[] $parameters
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
     * @param string[][]|Example[] $examples
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setExamples($examples)
    {
        $this->examples = $examples;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param string[][]|RequestBody[] $requestBodies
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setRequestBodies($requestBodies)
    {
        $this->requestBodies = $requestBodies;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param string[][]|Header[]|mixed[] $headers
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param string[][]|APIKeySecurityScheme[]|HTTPSecurityScheme[]|HTTPSecuritySchemeBearer[]|HTTPSecuritySchemeNonBearer[]|OAuth2SecurityScheme[]|OpenIdConnectSecurityScheme[] $securitySchemes
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setSecuritySchemes($securitySchemes)
    {
        $this->securitySchemes = $securitySchemes;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param string[][]|Link[] $links
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setLinks($links)
    {
        $this->links = $links;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param string[][]|PathItem[]|Operation[][][] $callbacks
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