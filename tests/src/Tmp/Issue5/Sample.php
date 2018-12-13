<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

use IfClass;
use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\Structure\ClassStructure;


class Sample extends ClassStructure
{
    /** @var string */
    public $foo;

    /** @var string */
    public $bar;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->foo = Schema::string();
        $properties->bar = Schema::string();
        $ownerSchema->type = 'object';
        $ownerSchema->if = IfClass::schema();
        $ownerSchema->then = new Schema();
        $ownerSchema->then->required = array(
            0 => 'bar',
        );
    }
}