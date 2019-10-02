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
 * Built from #/definitions/Link
 */
class Link extends ClassStructure
{
    const X_PROPERTY_PATTERN = '^x-';

    /** @var string */
    public $operationId;

    /** @var string */
    public $operationRef;

    /** @var array */
    public $parameters;

    /** @var mixed */
    public $requestBody;

    /** @var string */
    public $description;

    /** @var Server */
    public $server;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->operationId = Schema::string();
        $properties->operationRef = Schema::string();
        $properties->operationRef->format = "uri-reference";
        $properties->parameters = Schema::object();
        $properties->parameters->additionalProperties = new Schema();
        $properties->requestBody = new Schema();
        $properties->description = Schema::string();
        $properties->server = Server::schema();
        $ownerSchema->type = Schema::OBJECT;
        $ownerSchema->additionalProperties = false;
        $x = new Schema();
        $ownerSchema->setPatternProperty('^x-', $x);
        $ownerSchema->not = new Schema();
        $ownerSchema->not->description = "Operation Id and Operation Ref are mutually exclusive";
        $ownerSchema->not->required = array(
            self::names()->operationId,
            self::names()->operationRef,
        );
        $ownerSchema->setFromRef('#/definitions/Link');
    }

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
     * @param string $operationRef
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setOperationRef($operationRef)
    {
        $this->operationRef = $operationRef;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param array $parameters
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
     * @param mixed $requestBody
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
     * @param Server $server
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setServer(Server $server)
    {
        $this->server = $server;
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
        if (preg_match(Helper::toPregPattern(self::X_PROPERTY_PATTERN), $name)) {
            throw new StringException('Pattern mismatch', StringException::PATTERN_MISMATCH);
        }
        $this->addPatternPropertyName(self::X_PROPERTY_PATTERN, $name);
        $this->{$name} = $value;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */
}