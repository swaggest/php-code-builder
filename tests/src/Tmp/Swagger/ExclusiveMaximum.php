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
 * @method static bool import($data, Context $options=null)
 */
class ExclusiveMaximum extends ClassStructure {
	/**
	 * @param Properties|static $properties
	 * @param Schema $ownerSchema
	 */
	public static function setUpProperties($properties, Schema $ownerSchema)
	{
		$ownerSchema->type = Schema::BOOLEAN;
		$ownerSchema->default = false;
		$ownerSchema->setFromRef('http://json-schema.org/draft-04/schema#/properties/exclusiveMaximum');
		$ownerSchema->setFromRef('#/definitions/exclusiveMaximum');
	}
}