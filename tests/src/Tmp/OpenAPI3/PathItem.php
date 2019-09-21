<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swaggest\PhpCodeBuilder\Tests\Tmp\OpenAPI3;

use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Context;
use Swaggest\JsonSchema\Exception\StringException;
use Swaggest\JsonSchema\Helper;
use Swaggest\JsonSchema\InvalidValue;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\Structure\ClassStructure;


/**
 * Built from #/definitions/PathItem
 * @method static PathItem|Operation[] import($data, Context $options = null)
 */
class PathItem extends ClassStructure
{
    const GET_PUT_POST_DELETE_OPTIONS_HEAD_PATCH_TRACE_PROPERTY_PATTERN = '^(get|put|post|delete|options|head|patch|trace)$';

    /** @var string */
    public $ref;

    /** @var string */
    public $summary;

    /** @var string */
    public $description;

    /** @var Server[]|array */
    public $servers;

    /** @var Parameter[]|mixed[]|ParameterLocationParameterInPath[]|ParameterLocationParameterInQuery[]|ParameterLocationParameterInHeader[]|ParameterLocationParameterInCookie[]|string[][]|array */
    public $parameters;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->ref = Schema::string();
        $ownerSchema->addPropertyMapping('$ref', self::names()->ref);
        $properties->summary = Schema::string();
        $properties->description = Schema::string();
        $properties->servers = Schema::arr();
        $properties->servers->items = Server::schema();
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
        $ownerSchema->type = Schema::OBJECT;
        $ownerSchema->additionalProperties = false;
        $getPutPostDeleteOptionsHeadPatchTrace = Operation::schema();
        $ownerSchema->setPatternProperty('^(get|put|post|delete|options|head|patch|trace)$', $getPutPostDeleteOptionsHeadPatchTrace);
        $x = new Schema();
        $ownerSchema->setPatternProperty('^x-', $x);
        $ownerSchema->setFromRef('#/definitions/PathItem');
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
     * @return Operation[]
     * @codeCoverageIgnoreStart
     */
    public function getGetPutPostDeleteOptionsHeadPatchTraceValues()
    {
        $result = array();
        if (!$names = $this->getPatternPropertyNames(self::GET_PUT_POST_DELETE_OPTIONS_HEAD_PATCH_TRACE_PROPERTY_PATTERN)) {
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
     * @param Operation $value
     * @return self
     * @throws InvalidValue
     * @codeCoverageIgnoreStart
     */
    public function setGetPutPostDeleteOptionsHeadPatchTraceValue($name, Operation $value)
    {
        if (preg_match(Helper::toPregPattern(self::GET_PUT_POST_DELETE_OPTIONS_HEAD_PATCH_TRACE_PROPERTY_PATTERN), $name)) {
            throw new StringException('Pattern mismatch', StringException::PATTERN_MISMATCH);
        }
        $this->addPatternPropertyName(self::GET_PUT_POST_DELETE_OPTIONS_HEAD_PATCH_TRACE_PROPERTY_PATTERN, $name);
        $this->{$name} = $value;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */
}