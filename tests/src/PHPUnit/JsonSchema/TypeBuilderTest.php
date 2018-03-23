<?php

namespace Swaggest\PhpCodeBuilder\Tests\PHPUnit\JsonSchema;


use Swaggest\JsonSchema\JsonSchema;
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
        $schema = JsonSchema::import($schemaData);
        $phpBuilder = new PhpBuilder();
        $type = $phpBuilder->getType($schema);

        $file = new PhpFile();
        foreach ($phpBuilder->getGeneratedClasses() as $class) {
            $file->getCode()->addSnippet($class->class);
        }
        $this->assertSame(<<<'PHP'
class Untitled1 extends Swaggest\JsonSchema\Structure\ClassStructure {
	/** @var float */
	public $maximum;

	/**
	 * @param Swaggest\JsonSchema\Constraint\Properties|static $properties
	 * @param Swaggest\JsonSchema\Schema $ownerSchema
	 */
	public static function setUpProperties($properties, Swaggest\JsonSchema\Schema $ownerSchema)
	{
		$properties->maximum = Swaggest\JsonSchema\Schema::number();
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

        $this->assertSame('\\Untitled1', $type->renderPhpDocType());

    }

}