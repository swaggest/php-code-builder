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
 * The parameters needed to send a valid API call.
 * Built from #/definitions/parametersList
 * @method static BodyParameter[]|HeaderParameterSubSchema[]|FormDataParameterSubSchema[]|QueryParameterSubSchema[]|PathParameterSubSchema[]|JsonReference[]|array import($data, Context $options=null)
 */
class ParametersList extends ClassStructure {
	/**
	 * @param Properties|static $properties
	 * @param Schema $ownerSchema
	 */
	public static function setUpProperties($properties, Schema $ownerSchema)
	{
		$ownerSchema->type = Schema::_ARRAY;
		$ownerSchema->additionalItems = false;
		$ownerSchema->items = new Schema();
		$ownerSchema->items->oneOf[0] = Parameter::schema();
		$ownerSchema->items->oneOf[1] = JsonReference::schema();
		$ownerSchema->description = "The parameters needed to send a valid API call.";
		$ownerSchema->uniqueItems = true;
		$ownerSchema->setFromRef('#/definitions/parametersList');
	}
}