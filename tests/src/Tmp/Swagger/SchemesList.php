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
 * The transfer protocol of the API.
 * Built from #/definitions/schemesList
 * @method static string[]|array import($data, Context $options=null)
 */
class SchemesList extends ClassStructure {
	/**
	 * @param Properties|static $properties
	 * @param Schema $ownerSchema
	 */
	public static function setUpProperties($properties, Schema $ownerSchema)
	{
		$ownerSchema->type = Schema::_ARRAY;
		$ownerSchema->items = Schema::string();
		$ownerSchema->items->enum = array(
		    'http',
		    'https',
		    'ws',
		    'wss',
		);
		$ownerSchema->description = "The transfer protocol of the API.";
		$ownerSchema->uniqueItems = true;
		$ownerSchema->setFromRef('#/definitions/schemesList');
	}
}