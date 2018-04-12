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
 * @method static Response[]|JsonReference[] import($data, Context $options=null)
 */
class Responses extends ClassStructure {
	/**
	 * @param Properties|static $properties
	 * @param Schema $ownerSchema
	 */
	public static function setUpProperties($properties, Schema $ownerSchema)
	{
		$ownerSchema->type = 'object';
		$ownerSchema->additionalProperties = false;
		$patternProperty = ResponseValue::schema();
		$ownerSchema->setPatternProperty('^([0-9]{3})$|^(default)$', $patternProperty);
		$patternProperty = VendorExtension::schema();
		$ownerSchema->setPatternProperty('^x-', $patternProperty);
		$ownerSchema->not = Schema::object();
		$ownerSchema->not->additionalProperties = false;
		$patternProperty = VendorExtension::schema();
		$ownerSchema->not->setPatternProperty('^x-', $patternProperty);
		$ownerSchema->description = "Response objects names can either be any valid HTTP status code or 'default'.";
		$ownerSchema->minProperties = 1;
		$ownerSchema->setFromRef('#/definitions/responses');
	}
}