<?php

namespace Swaggest\PhpCodeBuilder\Tests\PHPUnit\JsonSchema;

use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\Structure\ClassStructure;
use Swaggest\PhpCodeBuilder\JsonSchema\PhpBuilder;
use Swaggest\PhpCodeBuilder\PhpFile;

class TypeBuilderTest extends \PHPUnit_Framework_TestCase
{
    public function testRef()
    {
        $schemaData = json_decode(<<<'JSON'
{
    "anyOf": [
        {},
        {"$ref":"#/definitions/header"}
    ],
    "definitions": {
        "header": {
            "type": "object",
            "properties": {
                "maximum": {"$ref": "#/definitions/maximum"}
            }
        },
        "maximum": {
            "$ref": "http://json-schema.org/draft-04/schema#/properties/maximum"
        }
    }
}
JSON
        );
        $schema = Schema::import($schemaData);
        $phpBuilder = new PhpBuilder();
        $phpBuilder->buildSetters = true;
        $type = $phpBuilder->getType($schema);

        $file = new PhpFile();
        foreach ($phpBuilder->getGeneratedClasses() as $class) {
            $file->getCode()->addSnippet($class->class);
        }
        $this->assertSame(<<<'PHP'
<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\Structure\ClassStructure;


class DefinitionsHeader extends ClassStructure {
	/** @var float */
	public $maximum;

	/**
	 * @param Properties|static $properties
	 * @param Schema $ownerSchema
	 */
	public static function setUpProperties($properties, Schema $ownerSchema)
	{
		$properties->maximum = Schema::number();
		$ownerSchema->type = 'object';
	}

	/**
	 * @param float $maximum
	 * @return $this
	 * @codeCoverageIgnoreStart
	 */
	public function setMaximum($maximum)
	{
		$this->maximum = $maximum;
		return $this;
	}
	/** @codeCoverageIgnoreEnd */
}
PHP
            , $file->render());

        /** @var ClassStructure $className */
        $className = $type->renderPhpDocType();
        $this->assertSame('\\DefinitionsHeader', $className);

        eval(substr($file->render(), 6));
        $exported = Schema::export($className::schema());
        $this->assertSame('{"properties":{"maximum":{"type":"number"}},"type":"object"}',
            json_encode($exported, JSON_UNESCAPED_SLASHES));
    }

}