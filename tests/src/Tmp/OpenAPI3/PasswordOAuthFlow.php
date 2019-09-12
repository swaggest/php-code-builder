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
 * Built from #/definitions/PasswordOAuthFlow
 */
class PasswordOAuthFlow extends ClassStructure
{
    const X_PROPERTY_PATTERN = '^x-';

    /** @var string */
    public $tokenUrl;

    /** @var string */
    public $refreshUrl;

    /** @var string[] */
    public $scopes;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->tokenUrl = Schema::string();
        $properties->tokenUrl->format = "uri-reference";
        $properties->refreshUrl = Schema::string();
        $properties->refreshUrl->format = "uri-reference";
        $properties->scopes = Schema::object();
        $properties->scopes->additionalProperties = Schema::string();
        $ownerSchema->type = 'object';
        $ownerSchema->additionalProperties = false;
        $x = new Schema();
        $ownerSchema->setPatternProperty('^x-', $x);
        $ownerSchema->required = array(
            self::names()->tokenUrl,
        );
        $ownerSchema->setFromRef('#/definitions/PasswordOAuthFlow');
    }

    /**
     * @param string $tokenUrl
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setTokenUrl($tokenUrl)
    {
        $this->tokenUrl = $tokenUrl;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param string $refreshUrl
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setRefreshUrl($refreshUrl)
    {
        $this->refreshUrl = $refreshUrl;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param string[] $scopes
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setScopes($scopes)
    {
        $this->scopes = $scopes;
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