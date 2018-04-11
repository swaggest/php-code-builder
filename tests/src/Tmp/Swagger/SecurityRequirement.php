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
 * @method static string[][]|array[] import($data, Context $options=null)
 */
class SecurityRequirement extends ClassStructure {
	/**
	 * @param Properties|static $properties
	 * @param Schema $ownerSchema
	 */
	public static function setUpProperties($properties, Schema $ownerSchema)
	{
		$ownerSchema->type = 'object';
		$ownerSchema->additionalProperties = Schema::arr();
		$ownerSchema->additionalProperties->items = Schema::string();
		$ownerSchema->additionalProperties->uniqueItems = true;
		$ownerSchema->setFromRef('#/definitions/securityRequirement');
	}
}