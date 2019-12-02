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
 * A JSON Schema for Swagger 2.0 API.
 */
class SwaggerSchema extends ClassStructure
{
    const CONST_2_0 = '2.0';

    const HTTP = 'http';

    const HTTPS = 'https';

    const WS = 'ws';

    const WSS = 'wss';

    const X_PROPERTY_PATTERN = '^x-';

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
            self::CONST_2_0,
        );
        $properties->swagger->description = "The Swagger version of this document.";
        $properties->info = Info::schema();
        $properties->host = Schema::string();
        $properties->host->description = "The\nhost (name or ip) of the API. Example: 'swagger.io'";
        $properties->host->pattern = "^[^{}/ :\\\\]+(?::\\d+)?$";
        $properties->basePath = Schema::string();
        $properties->basePath->description = "The base path to the API. Example: '/api'.";
        $properties->basePath->pattern = "^/";
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
        $properties->consumes = new Schema();
        $propertiesConsumesAllOf0 = Schema::arr();
        $propertiesConsumesAllOf0->items = Schema::string();
        $propertiesConsumesAllOf0->items->description = "The MIME type of the HTTP message.";
        $propertiesConsumesAllOf0->items->setFromRef('#/definitions/mimeType');
        $propertiesConsumesAllOf0->uniqueItems = true;
        $propertiesConsumesAllOf0->setFromRef('#/definitions/mediaTypeList');
        $properties->consumes->allOf[0] = $propertiesConsumesAllOf0;
        $properties->consumes->description = "A list of MIME types accepted by the API.";
        $properties->produces = new Schema();
        $propertiesProducesAllOf0 = Schema::arr();
        $propertiesProducesAllOf0->items = Schema::string();
        $propertiesProducesAllOf0->items->description = "The MIME type of the HTTP message.";
        $propertiesProducesAllOf0->items->setFromRef('#/definitions/mimeType');
        $propertiesProducesAllOf0->uniqueItems = true;
        $propertiesProducesAllOf0->setFromRef('#/definitions/mediaTypeList');
        $properties->produces->allOf[0] = $propertiesProducesAllOf0;
        $properties->produces->description = "A list of MIME types the API can produce.";
        $properties->paths = Schema::object();
        $properties->paths->additionalProperties = false;
        $x = new Schema();
        $x->additionalProperties = true;
        $x->additionalItems = true;
        $x->description = "Any property starting with x- is valid.";
        $x->setFromRef('#/definitions/vendorExtension');
        $properties->paths->setPatternProperty('^x-', $x);
        $property5e3697 = PathItem::schema();
        $properties->paths->setPatternProperty('^/', $property5e3697);
        $properties->paths->description = "Relative paths to the individual endpoints. They must be relative to the 'basePath'.";
        $properties->paths->setFromRef('#/definitions/paths');
        $properties->definitions = Schema::object();
        $properties->definitions->additionalProperties = DefinitionsSchema::schema();
        $properties->definitions->description = "One or more JSON objects describing the schemas being consumed and produced by the API.";
        $properties->definitions->setFromRef('#/definitions/definitions');
        $properties->parameters = Schema::object();
        $properties->parameters->additionalProperties = new Schema();
        $properties->parameters->additionalProperties->oneOf[0] = BodyParameter::schema();
        $propertiesParametersAdditionalPropertiesOneOf1 = Schema::object();
        $propertiesParametersAdditionalPropertiesOneOf1->oneOf[0] = HeaderParameterSubSchema::schema();
        $propertiesParametersAdditionalPropertiesOneOf1->oneOf[1] = FormDataParameterSubSchema::schema();
        $propertiesParametersAdditionalPropertiesOneOf1->oneOf[2] = QueryParameterSubSchema::schema();
        $propertiesParametersAdditionalPropertiesOneOf1->oneOf[3] = PathParameterSubSchema::schema();
        $propertiesParametersAdditionalPropertiesOneOf1->required = array(
            self::names()->name,
            self::names()->in,
            self::names()->type,
        );
        $propertiesParametersAdditionalPropertiesOneOf1->setFromRef('#/definitions/nonBodyParameter');
        $properties->parameters->additionalProperties->oneOf[1] = $propertiesParametersAdditionalPropertiesOneOf1;
        $properties->parameters->additionalProperties->setFromRef('#/definitions/parameter');
        $properties->parameters->description = "One or more JSON representations for parameters";
        $properties->parameters->setFromRef('#/definitions/parameterDefinitions');
        $properties->responses = Schema::object();
        $properties->responses->additionalProperties = Response::schema();
        $properties->responses->description = "One or more JSON representations for parameters";
        $properties->responses->setFromRef('#/definitions/responseDefinitions');
        $properties->security = Schema::arr();
        $properties->security->items = Schema::object();
        $properties->security->items->additionalProperties = Schema::arr();
        $properties->security->items->additionalProperties->items = Schema::string();
        $properties->security->items->additionalProperties->uniqueItems = true;
        $properties->security->items->setFromRef('#/definitions/securityRequirement');
        $properties->security->uniqueItems = true;
        $properties->security->setFromRef('#/definitions/security');
        $properties->securityDefinitions = Schema::object();
        $properties->securityDefinitions->additionalProperties = new Schema();
        $properties->securityDefinitions->additionalProperties->oneOf[0] = BasicAuthenticationSecurity::schema();
        $properties->securityDefinitions->additionalProperties->oneOf[1] = ApiKeySecurity::schema();
        $properties->securityDefinitions->additionalProperties->oneOf[2] = Oauth2ImplicitSecurity::schema();
        $properties->securityDefinitions->additionalProperties->oneOf[3] = Oauth2PasswordSecurity::schema();
        $properties->securityDefinitions->additionalProperties->oneOf[4] = Oauth2ApplicationSecurity::schema();
        $properties->securityDefinitions->additionalProperties->oneOf[5] = Oauth2AccessCodeSecurity::schema();
        $properties->securityDefinitions->setFromRef('#/definitions/securityDefinitions');
        $properties->tags = Schema::arr();
        $properties->tags->items = Tag::schema();
        $properties->tags->uniqueItems = true;
        $properties->externalDocs = ExternalDocs::schema();
        $ownerSchema->type = Schema::OBJECT;
        $ownerSchema->additionalProperties = false;
        $x = new Schema();
        $x->additionalProperties = true;
        $x->additionalItems = true;
        $x->description = "Any property starting with x- is valid.";
        $x->setFromRef('#/definitions/vendorExtension');
        $ownerSchema->setPatternProperty('^x-', $x);
        $ownerSchema->id = "http://swagger.io/v2/schema.json#";
        $ownerSchema->schema = "http://json-schema.org/draft-04/schema#";
        $ownerSchema->title = "A JSON Schema for Swagger 2.0 API.";
        $ownerSchema->required = array(
            self::names()->swagger,
            self::names()->info,
            self::names()->paths,
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
    public function setInfo(Info $info)
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
    public function setExternalDocs(ExternalDocs $externalDocs)
    {
        $this->externalDocs = $externalDocs;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @return array
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
        if (!preg_match(Helper::toPregPattern(self::X_PROPERTY_PATTERN), $name)) {
            throw new StringException('Pattern mismatch', StringException::PATTERN_MISMATCH);
        }
        $this->addPatternPropertyName(self::X_PROPERTY_PATTERN, $name);
        $this->{$name} = $value;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */
}