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
 * Built from http://json-schema.org/draft-04/schema#/definitions/positiveIntegerDefault0
 *  <- #/definitions/minLength
 * @method static int import($data, Context $options = null)
 */
class MinLength extends ClassStructure
{
    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $ownerSchema->allOf[0] = HttpJsonSchemaOrgDraft04SchemaDefinitionsPositiveInteger::schema();
        $ownerSchemaAllOf1 = new Schema();
        $ownerSchemaAllOf1->default = 0;
        $ownerSchema->allOf[1] = $ownerSchemaAllOf1;
        $ownerSchema->setFromRef('http://json-schema.org/draft-04/schema#/definitions/positiveIntegerDefault0');
        $ownerSchema->setFromRef('#/definitions/minLength');
    }
}