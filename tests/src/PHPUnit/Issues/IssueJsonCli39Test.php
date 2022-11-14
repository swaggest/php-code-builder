<?php

namespace Swaggest\PhpCodeBuilder\Tests\PHPUnit\Issues;

use Swaggest\JsonSchema\Exception\ConstException;
use Swaggest\JsonSchema\Exception\ObjectException;
use Swaggest\JsonSchema\Schema;
use Swaggest\PhpCodeBuilder\App\PhpApp;
use Swaggest\PhpCodeBuilder\JsonSchema\ClassHookCallback;
use Swaggest\PhpCodeBuilder\JsonSchema\PhpBuilder;
use Swaggest\PhpCodeBuilder\PhpClass;
use Swaggest\PhpCodeBuilder\Tests\Tmp\Issue40\Sample;

/**
 * @see https://github.com/swaggest/json-cli/issues/39
 */
class IssueJsonCli39Test extends \PHPUnit_Framework_TestCase
{
    function testIssue39()
    {
        $schemaJson = <<<'JSON'
{
    "id": "/Test",
    "type": "object",
    "properties": {
        "label": {
            "anyOf": [
                {
                    "type": "integer"
                },
                {
                    "type": "number"
                },
                {
                    "type": "object",
                    "properties": {
                        "test1": {
                            "type": "string"
                        }
                    }
                },
                {
                    "type": "object",
                    "properties": {
                        "test2": {
                            "type": "string"
                        }
                    }
                }
            ]
        },
        "label2": {
            "oneOf": [
                {
                    "type": "integer"
                },
                {
                    "type": "number"
                },
                {
                    "type": "object",
                    "properties": {
                        "test1": {
                            "type": "string"
                        }
                    }
                },
                {
                    "type": "object",
                    "properties": {
                        "test2": {
                            "type": "string"
                        }
                    }
                }
            ]
        }
    }
}
JSON;
        $schemaData = json_decode($schemaJson);

        $schema = Schema::import($schemaData);
        $builder = new PhpBuilder();
        $class = $builder->getClass($schema, 'Root');

        $result = '';
        foreach ($builder->getGeneratedClasses() as $class) {
            $result .= $class->class . "\n\n";
        }

        $expected = <<<'PHP'
class Root extends Swaggest\JsonSchema\Structure\ClassStructure
{
    /** @var int|float|\RootLabelAnyOf2|\RootLabelAnyOf3 */
    public $label;

    /** @var int|float|\RootLabel2OneOf2|\RootLabel2OneOf3 */
    public $label2;

    /**
     * @param Swaggest\JsonSchema\Constraint\Properties|static $properties
     * @param Swaggest\JsonSchema\Schema $ownerSchema
     */
    public static function setUpProperties($properties, Swaggest\JsonSchema\Schema $ownerSchema)
    {
        $properties->label = new Swaggest\JsonSchema\Schema();
        $properties->label->anyOf[0] = Swaggest\JsonSchema\Schema::integer();
        $properties->label->anyOf[1] = Swaggest\JsonSchema\Schema::number();
        $properties->label->anyOf[2] = \RootLabelAnyOf2::schema();
        $properties->label->anyOf[3] = \RootLabelAnyOf3::schema();
        $properties->label2 = new Swaggest\JsonSchema\Schema();
        $properties->label2->oneOf[0] = Swaggest\JsonSchema\Schema::integer();
        $properties->label2->oneOf[1] = Swaggest\JsonSchema\Schema::number();
        $properties->label2->oneOf[2] = \RootLabel2OneOf2::schema();
        $properties->label2->oneOf[3] = \RootLabel2OneOf3::schema();
        $ownerSchema->type = Swaggest\JsonSchema\Schema::OBJECT;
        $ownerSchema->id = "/Test";
    }
}

class RootLabelAnyOf2 extends Swaggest\JsonSchema\Structure\ClassStructure
{
    /** @var string */
    public $test1;

    /**
     * @param Swaggest\JsonSchema\Constraint\Properties|static $properties
     * @param Swaggest\JsonSchema\Schema $ownerSchema
     */
    public static function setUpProperties($properties, Swaggest\JsonSchema\Schema $ownerSchema)
    {
        $properties->test1 = Swaggest\JsonSchema\Schema::string();
        $ownerSchema->type = Swaggest\JsonSchema\Schema::OBJECT;
    }
}

class RootLabelAnyOf3 extends Swaggest\JsonSchema\Structure\ClassStructure
{
    /** @var string */
    public $test2;

    /**
     * @param Swaggest\JsonSchema\Constraint\Properties|static $properties
     * @param Swaggest\JsonSchema\Schema $ownerSchema
     */
    public static function setUpProperties($properties, Swaggest\JsonSchema\Schema $ownerSchema)
    {
        $properties->test2 = Swaggest\JsonSchema\Schema::string();
        $ownerSchema->type = Swaggest\JsonSchema\Schema::OBJECT;
    }
}

class RootLabel2OneOf2 extends Swaggest\JsonSchema\Structure\ClassStructure
{
    /** @var string */
    public $test1;

    /**
     * @param Swaggest\JsonSchema\Constraint\Properties|static $properties
     * @param Swaggest\JsonSchema\Schema $ownerSchema
     */
    public static function setUpProperties($properties, Swaggest\JsonSchema\Schema $ownerSchema)
    {
        $properties->test1 = Swaggest\JsonSchema\Schema::string();
        $ownerSchema->type = Swaggest\JsonSchema\Schema::OBJECT;
    }
}

class RootLabel2OneOf3 extends Swaggest\JsonSchema\Structure\ClassStructure
{
    /** @var string */
    public $test2;

    /**
     * @param Swaggest\JsonSchema\Constraint\Properties|static $properties
     * @param Swaggest\JsonSchema\Schema $ownerSchema
     */
    public static function setUpProperties($properties, Swaggest\JsonSchema\Schema $ownerSchema)
    {
        $properties->test2 = Swaggest\JsonSchema\Schema::string();
        $ownerSchema->type = Swaggest\JsonSchema\Schema::OBJECT;
    }
}


PHP;


        $this->assertSame($expected, $result);
    }


    function testIssue39_2()
    {
        $schemaJson = <<<'JSON'
{
    "id": "/Test",
    "anyOf": [
        {
            "type": "object",
            "properties": {
                "test1": {
                    "type": "string"
                }
            }
        },
        {
            "type": "object",
            "properties": {
                "test2": {
                    "type": "integer"
                }
            }
        }
    ]
}
JSON;
        $schemaData = json_decode($schemaJson);

        $schema = Schema::import($schemaData);
        $builder = new PhpBuilder();
        $class = $builder->getClass($schema, 'Root');

        $result = '';
        foreach ($builder->getGeneratedClasses() as $class) {
            $result .= $class->class . "\n\n";
        }

        $expected = <<<'PHP'
/**
 * @method static \RootAnyOf0|\RootAnyOf1 import($data, Swaggest\JsonSchema\Context $options = null)
 */
class Root extends Swaggest\JsonSchema\Structure\ClassStructure
{
    /**
     * @param Swaggest\JsonSchema\Constraint\Properties|static $properties
     * @param Swaggest\JsonSchema\Schema $ownerSchema
     */
    public static function setUpProperties($properties, Swaggest\JsonSchema\Schema $ownerSchema)
    {
        $ownerSchema->anyOf[0] = \RootAnyOf0::schema();
        $ownerSchema->anyOf[1] = \RootAnyOf1::schema();
        $ownerSchema->id = "/Test";
    }
}

class RootAnyOf0 extends Swaggest\JsonSchema\Structure\ClassStructure
{
    /** @var string */
    public $test1;

    /**
     * @param Swaggest\JsonSchema\Constraint\Properties|static $properties
     * @param Swaggest\JsonSchema\Schema $ownerSchema
     */
    public static function setUpProperties($properties, Swaggest\JsonSchema\Schema $ownerSchema)
    {
        $properties->test1 = Swaggest\JsonSchema\Schema::string();
        $ownerSchema->type = Swaggest\JsonSchema\Schema::OBJECT;
    }
}

class RootAnyOf1 extends Swaggest\JsonSchema\Structure\ClassStructure
{
    /** @var int */
    public $test2;

    /**
     * @param Swaggest\JsonSchema\Constraint\Properties|static $properties
     * @param Swaggest\JsonSchema\Schema $ownerSchema
     */
    public static function setUpProperties($properties, Swaggest\JsonSchema\Schema $ownerSchema)
    {
        $properties->test2 = Swaggest\JsonSchema\Schema::integer();
        $ownerSchema->type = Swaggest\JsonSchema\Schema::OBJECT;
    }
}


PHP;


        $this->assertSame($expected, $result);
    }
}