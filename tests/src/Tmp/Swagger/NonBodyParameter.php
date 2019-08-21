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
 * Built from #/definitions/nonBodyParameter
 * @method static HeaderParameterSubSchema|FormDataParameterSubSchema|QueryParameterSubSchema|PathParameterSubSchema import($data, Context $options = null)
 */
class NonBodyParameter extends ClassStructure
{
    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $ownerSchema->type = 'object';
        $ownerSchema->oneOf[0] = HeaderParameterSubSchema::schema();
        $ownerSchema->oneOf[1] = FormDataParameterSubSchema::schema();
        $ownerSchema->oneOf[2] = QueryParameterSubSchema::schema();
        $ownerSchema->oneOf[3] = PathParameterSubSchema::schema();
        $ownerSchema->required = array(
            self::names()->name,
            self::names()->in,
            self::names()->type,
        );
        $ownerSchema->setFromRef('#/definitions/nonBodyParameter');
    }
}