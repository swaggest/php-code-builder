<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swaggest\PhpCodeBuilder\Tests\Tmp\Example;

use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\Structure\ClassStructure;


/**
 * Built from #/definitions/info
 */
class Info extends ClassStructure
{
    /** @var string */
    public $lastName;

    /** @var string */
    public $birthDate;

    /** @var Options */
    public $options;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->lastName = Schema::string();
        $properties->birthDate = Schema::string();
        $properties->birthDate->format = "date";
        $properties->options = Options::schema();
        $ownerSchema->type = Schema::OBJECT;
        $ownerSchema->setFromRef('#/definitions/info');
    }

    /**
     * @param string $lastName
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param string $birthDate
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param Options $options
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setOptions(Options $options)
    {
        $this->options = $options;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */
}