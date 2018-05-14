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
 * Built from http://json-schema.org/draft-04/schema#/properties/type
 * @method static array import($data, Context $options=null)
 */
class HttpJsonSchemaOrgDraft04SchemaPropertiesType extends ClassStructure {
	/**
	 * @param Properties|static $properties
	 * @param Schema $ownerSchema
	 */
	public static function setUpProperties($properties, Schema $ownerSchema)
	{
		$ownerSchema->anyOf[0] = SimpleTypes::schema();
		$ownerSchema->anyOf[1] = Schema::arr();
		$ownerSchema->anyOf[1]->items = SimpleTypes::schema();
		$ownerSchema->anyOf[1]->minItems = 1;
		$ownerSchema->anyOf[1]->uniqueItems = true;
		$ownerSchema->setFromRef('http://json-schema.org/draft-04/schema#/properties/type');
	}
}