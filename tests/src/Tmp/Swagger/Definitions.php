<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swaggest\PhpCodeBuilder\Tests\Tmp\Swagger;

use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Context;
use Swaggest\JsonSchema\Schema as Schema1;
use Swaggest\JsonSchema\Structure\ClassStructure;


/**
 * One or more JSON objects describing the schemas being consumed and produced by the API.
 * Built from #/definitions/definitions
 * @method static Schema[] import($data, Context $options=null)
 */
class Definitions extends ClassStructure {
	/**
	 * @param Properties|static $properties
	 * @param Schema1 $ownerSchema
	 */
	public static function setUpProperties($properties, Schema1 $ownerSchema)
	{
		$ownerSchema->type = 'object';
		$ownerSchema->additionalProperties = Schema::schema();
		$ownerSchema->description = "One or more JSON objects describing the schemas being consumed and produced by the API.";
		$ownerSchema->setFromRef('#/definitions/definitions');
	}
}