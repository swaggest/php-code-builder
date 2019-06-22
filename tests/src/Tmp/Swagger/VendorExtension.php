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
 * Any property starting with x- is valid.
 * Built from #/definitions/vendorExtension
 * @method static mixed import($data, Context $options = null)
 */
class VendorExtension extends ClassStructure
{
    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $ownerSchema->additionalProperties = true;
        $ownerSchema->additionalItems = true;
        $ownerSchema->description = "Any property starting with x- is valid.";
        $ownerSchema->setFromRef('#/definitions/vendorExtension');
    }
}