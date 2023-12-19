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
 * Built from #/definitions/XML
 * @property string $name
 * @property string $namespace
 * @property string $prefix
 * @property bool $attribute
 * @property bool $wrapped
 */
class XML extends ClassStructure
{
    const X_PROPERTY_PATTERN = '^x-';

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->name = Schema::string();
        $properties->namespace = Schema::string();
        $properties->namespace->format = "uri";
        $properties->prefix = Schema::string();
        $properties->attribute = Schema::boolean();
        $properties->attribute->default = false;
        $properties->wrapped = Schema::boolean();
        $properties->wrapped->default = false;
        $ownerSchema->type = Schema::OBJECT;
        $ownerSchema->additionalProperties = false;
        $x = new Schema();
        $ownerSchema->setPatternProperty('^x-', $x);
        $ownerSchema->setFromRef('#/definitions/XML');
    }

    /**
     * @param string $name
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param string $namespace
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setNamespace($namespace)
    {
        $this->namespace = $namespace;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param string $prefix
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param bool $attribute
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setAttribute($attribute)
    {
        $this->attribute = $attribute;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param bool $wrapped
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setWrapped($wrapped)
    {
        $this->wrapped = $wrapped;
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