<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swaggest\PhpCodeBuilder\Tests\Tmp\Swagger;

use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Context;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\Structure\ClassStructure;


/**
 * One or more JSON representations for parameters
 * Built from #/definitions/parameterDefinitions
 * @method static BodyParameter[]|HeaderParameterSubSchema[]|FormDataParameterSubSchema[]|QueryParameterSubSchema[]|PathParameterSubSchema[] import($data, Context $options = null)
 */
class ParameterDefinitions extends ClassStructure
{
    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $ownerSchema->type = Schema::OBJECT;
        $ownerSchema->additionalProperties = Parameter::schema();
        $ownerSchema->description = "One or more JSON representations for parameters";
        $ownerSchema->setFromRef('#/definitions/parameterDefinitions');
    }

    /**
     * @return BodyParameter[]|HeaderParameterSubSchema[]|FormDataParameterSubSchema[]|QueryParameterSubSchema[]|PathParameterSubSchema[]
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
     * @param BodyParameter|HeaderParameterSubSchema|FormDataParameterSubSchema|QueryParameterSubSchema|PathParameterSubSchema $value
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
}