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
 * Built from #/definitions/options
 */
class Options extends ClassStructure
{
    /** @var bool */
    public $rememberSession;

    /** @var bool */
    public $allowNotifications;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->rememberSession = Schema::boolean();
        $properties->allowNotifications = Schema::boolean();
        $ownerSchema->type = Schema::OBJECT;
        $ownerSchema->setFromRef('#/definitions/options');
    }

    /**
     * @param bool $rememberSession
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setRememberSession($rememberSession)
    {
        $this->rememberSession = $rememberSession;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param bool $allowNotifications
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setAllowNotifications($allowNotifications)
    {
        $this->allowNotifications = $allowNotifications;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */
}