<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swaggest\PhpCodeBuilder\Tests\Tmp\OpenAPI3;

use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\Structure\ClassStructure;


/**
 * Built from #/definitions/Discriminator
 * @property string[] $mapping
 */
class Discriminator extends ClassStructure
{
    /** @var string */
    public $propertyName;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->propertyName = Schema::string();
        $properties->mapping = Schema::object();
        $properties->mapping->additionalProperties = Schema::string();
        $ownerSchema->type = Schema::OBJECT;
        $ownerSchema->required = array(
            self::names()->propertyName,
        );
        $ownerSchema->setFromRef('#/definitions/Discriminator');
    }

    /**
     * @param string $propertyName
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setPropertyName($propertyName)
    {
        $this->propertyName = $propertyName;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param string[] $mapping
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setMapping($mapping)
    {
        $this->mapping = $mapping;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */
}