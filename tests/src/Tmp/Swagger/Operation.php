<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swaggest\PhpCodeBuilder\Tests\Tmp\Swagger;

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

    /** @var Response objects names can either be any valid HTTP status code or 'default'. */
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
        $properties->produces->allOf[0] = MediaTypeList::schema();
        $properties->produces->description = "A list of MIME types the API can produce.";
        $properties->consumes = new Schema();
        $properties->consumes->allOf[0] = MediaTypeList::schema();
        $properties->consumes->description = "A list of MIME types the API can consume.";
        $properties->parameters = ParametersList::schema();
        $properties->responses = Responses::schema();
        $properties->schemes = SchemesList::schema();
        $properties->deprecated = Schema::boolean();
        $properties->deprecated->default = false;
        $properties->security = Security::schema();
        $ownerSchema->type = 'object';
        $ownerSchema->additionalProperties = false;
        $patternProperty = VendorExtension::schema();
        $ownerSchema->setPatternProperty('^x-', $patternProperty);
        $ownerSchema->required = array(
            0 => 'responses',
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
     * @param $responses Response objects names can either be any valid HTTP status code or 'default'.
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
     * @param $value
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