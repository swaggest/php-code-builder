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
 * @method static BodyParameter|HeaderParameterSubSchema|FormDataParameterSubSchema|QueryParameterSubSchema|PathParameterSubSchema import($data, Context $options=null)
 */
class Parameter extends ClassStructure {
	/**
	 * @param Properties|static $properties
	 * @param Schema $ownerSchema
	 */
	public static function setUpProperties($properties, Schema $ownerSchema)
	{
		$ownerSchema->oneOf[0] = BodyParameter::schema();
		$ownerSchema->oneOf[1] = NonBodyParameter::schema();
		$ownerSchema->setFromRef('#/definitions/parameter');
	}
}