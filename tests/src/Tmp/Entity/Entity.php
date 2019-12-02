<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swaggest\PhpCodeBuilder\Tests\Tmp\Entity;

use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Context;
use Swaggest\JsonSchema\Exception\StringException;
use Swaggest\JsonSchema\Helper;
use Swaggest\JsonSchema\InvalidValue;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\Structure\ClassStructure;


/**
 * @method static Entity|string[]|int[]|bool[]|null|array import($data, Context $options = null)
 */
class Entity extends ClassStructure
{
    const X_PROPERTY_PATTERN = '^x-';

    const Z_PROPERTY_PATTERN = '^z-';

    /** @var string */
    public $namedProperty;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->namedProperty = Schema::string();
        $ownerSchema->addPropertyMapping('namedProperty$$$#%', self::names()->namedProperty);
        $ownerSchema->type = [Schema::OBJECT, Schema::NULL, Schema::_ARRAY];
        $ownerSchema->additionalProperties = Schema::string();
        $x = Schema::integer();
        $ownerSchema->setPatternProperty('^x-', $x);
        $z = Schema::boolean();
        $ownerSchema->setPatternProperty('^z-', $z);
    }

    /**
     * @param string $namedProperty
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setNamedProperty($namedProperty)
    {
        $this->namedProperty = $namedProperty;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @return string[]
     * @codeCoverageIgnoreStart
     */
    public function getAdditionalPropertyValues()
    {
        $result = array();
        if (!$names = $this->getAdditionalPropertyNames()) {
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
     * @param string $value
     * @return self
     * @codeCoverageIgnoreStart
     */
    public function setAdditionalPropertyValue($name, $value)
    {
        $this->addAdditionalPropertyName($name);
        $this->{$name} = $value;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @return int[]
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
     * @param int $value
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

    /**
     * @return bool[]
     * @codeCoverageIgnoreStart
     */
    public function getZValues()
    {
        $result = array();
        if (!$names = $this->getPatternPropertyNames(self::Z_PROPERTY_PATTERN)) {
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
     * @param bool $value
     * @return self
     * @throws InvalidValue
     * @codeCoverageIgnoreStart
     */
    public function setZValue($name, $value)
    {
        if (!preg_match(Helper::toPregPattern(self::Z_PROPERTY_PATTERN), $name)) {
            throw new StringException('Pattern mismatch', StringException::PATTERN_MISMATCH);
        }
        $this->addPatternPropertyName(self::Z_PROPERTY_PATTERN, $name);
        $this->{$name} = $value;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */
}