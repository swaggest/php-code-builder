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
 * Built from #/definitions/oauth2Scopes
 * @method static string[] import($data, Context $options = null)
 */
class Oauth2Scopes extends ClassStructure
{
    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $ownerSchema->type = Schema::OBJECT;
        $ownerSchema->additionalProperties = Schema::string();
        $ownerSchema->setFromRef('#/definitions/oauth2Scopes');
    }

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
}