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
 * Built from #/definitions/OpenIdConnectSecurityScheme
 */
class OpenIdConnectSecurityScheme extends ClassStructure
{
    const OPEN_ID_CONNECT = 'openIdConnect';

    const X_PROPERTY_PATTERN = '^x-';

    /** @var string */
    public $type;

    /** @var string */
    public $openIdConnectUrl;

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
            self::OPEN_ID_CONNECT,
        );
        $properties->openIdConnectUrl = Schema::string();
        $properties->openIdConnectUrl->format = "uri-reference";
        $properties->description = Schema::string();
        $ownerSchema->type = 'object';
        $ownerSchema->additionalProperties = false;
        $patternProperty = new Schema();
        $ownerSchema->setPatternProperty('^x-', $patternProperty);
        $ownerSchema->required = array(
            self::names()->type,
            self::names()->openIdConnectUrl,
        );
        $ownerSchema->setFromRef('#/definitions/OpenIdConnectSecurityScheme');
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
     * @param string $openIdConnectUrl
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setOpenIdConnectUrl($openIdConnectUrl)
    {
        $this->openIdConnectUrl = $openIdConnectUrl;
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