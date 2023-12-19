<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swaggest\PhpCodeBuilder\Tests\Tmp\Issue5;

use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\Structure\ClassStructure;


/**
 * @property string $foo
 * @property string $bar
 */
class Sample extends ClassStructure
{
    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->foo = Schema::string();
        $properties->bar = Schema::string();
        $ownerSchema->type = Schema::OBJECT;
        $ownerSchema->if = IfClass::schema();
        $ownerSchema->then = new Schema();
        $ownerSchema->then->required = array(
            self::names()->bar,
        );
    }
}