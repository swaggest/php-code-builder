<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swaggest\PhpCodeBuilder\Tests\Tmp\Swagger;

use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Context;
use Swaggest\JsonSchema\Exception\StringException;
use Swaggest\JsonSchema\Helper;
use Swaggest\JsonSchema\InvalidValue;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\Structure\ClassStructure;


/**
 * Response objects names can either be any valid HTTP status code or 'default'.
 * Built from #/definitions/responses
 * @method static Response[]|JsonReference[] import($data, Context $options = null)
 */
class Responses extends ClassStructure
{
    const CONST_0_9_3_DEFAULT_PROPERTY_PATTERN = '^([0-9]{3})$|^(default)$';

    const X_PROPERTY_PATTERN = '^x-';

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $ownerSchema->type = 'object';
        $ownerSchema->additionalProperties = false;
        $patternProperty = ResponseValue::schema();
        $ownerSchema->setPatternProperty('^([0-9]{3})$|^(default)$', $patternProperty);
        $patternProperty = VendorExtension::schema();
        $ownerSchema->setPatternProperty('^x-', $patternProperty);
        $ownerSchema->not = Schema::object();
        $ownerSchema->not->additionalProperties = false;
        $patternProperty = VendorExtension::schema();
        $ownerSchema->not->setPatternProperty('^x-', $patternProperty);
        $ownerSchema->description = "Response objects names can either be any valid HTTP status code or 'default'.";
        $ownerSchema->minProperties = 1;
        $ownerSchema->setFromRef('#/definitions/responses');
    }

    /**
     * @return Response[]|JsonReference[]
     * @codeCoverageIgnoreStart
     */
    public function getproperty093DefaultValues()
    {
        $result = array();
        if (!$names = $this->getPatternPropertyNames(self::CONST_0_9_3_DEFAULT_PROPERTY_PATTERN)) {
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
     * @param Response|JsonReference $value
     * @return self
     * @throws InvalidValue
     * @codeCoverageIgnoreStart
     */
    public function setproperty093DefaultValue($name, $value)
    {
        if (preg_match(Helper::toPregPattern(self::CONST_0_9_3_DEFAULT_PROPERTY_PATTERN), $name)) {
            throw new StringException('Pattern mismatch', StringException::PATTERN_MISMATCH);
        }
        $this->addPatternPropertyName(self::CONST_0_9_3_DEFAULT_PROPERTY_PATTERN, $name);
        $this->{$name} = $value;
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