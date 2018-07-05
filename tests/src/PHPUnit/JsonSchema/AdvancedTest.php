<?php

namespace Swaggest\PhpCodeBuilder\Tests\PHPUnit\JsonSchema;


use Swaggest\JsonSchema\Schema;
use Swaggest\PhpCodeBuilder\JsonSchema\PhpBuilder;

class AdvancedTest extends \PHPUnit_Framework_TestCase
{
    public function testOneOf() {
        $schemaData = json_decode(<<<'JSON'
{"oneOf": [
  {"properties": {
    "foo": {"enum": ["a"]},
    "bar": {"multipleOf": 3}
  }},
  {"properties": {
    "foo": {"enum": ["b"]},
    "bar": {"multipleOf": 5}
  }}
]}
JSON
);

        $schema = Schema::import($schemaData);
        $builder = new PhpBuilder();
        $class = $builder->getClass($schema, 'Root');

        $result = '';
        foreach ($builder->getGeneratedClasses() as $class) {
            $result .= $class->class . "\n\n";
        }

        $expected = <<<'PHP'
/**
 * @method static \RootOneOf0|\RootOneOf1 import($data, Swaggest\JsonSchema\Context $options=null)
 */
class Root extends Swaggest\JsonSchema\Structure\ClassStructure {
	/**
	 * @param Swaggest\JsonSchema\Constraint\Properties|static $properties
	 * @param Swaggest\JsonSchema\Schema $ownerSchema
	 */
	public static function setUpProperties($properties, Swaggest\JsonSchema\Schema $ownerSchema)
	{
		$ownerSchema->oneOf[0] = \RootOneOf0::schema();
		$ownerSchema->oneOf[1] = \RootOneOf1::schema();
	}
}

class RootOneOf0 extends Swaggest\JsonSchema\Structure\ClassStructure {
	public $foo;

	public $bar;

	/**
	 * @param Swaggest\JsonSchema\Constraint\Properties|static $properties
	 * @param Swaggest\JsonSchema\Schema $ownerSchema
	 */
	public static function setUpProperties($properties, Swaggest\JsonSchema\Schema $ownerSchema)
	{
		$properties->foo = new Swaggest\JsonSchema\Schema();
		$properties->foo->enum = array(
		    'a',
		);
		$properties->bar = new Swaggest\JsonSchema\Schema();
		$properties->bar->multipleOf = 3;
	}
}

class RootOneOf1 extends Swaggest\JsonSchema\Structure\ClassStructure {
	public $foo;

	public $bar;

	/**
	 * @param Swaggest\JsonSchema\Constraint\Properties|static $properties
	 * @param Swaggest\JsonSchema\Schema $ownerSchema
	 */
	public static function setUpProperties($properties, Swaggest\JsonSchema\Schema $ownerSchema)
	{
		$properties->foo = new Swaggest\JsonSchema\Schema();
		$properties->foo->enum = array(
		    'b',
		);
		$properties->bar = new Swaggest\JsonSchema\Schema();
		$properties->bar->multipleOf = 5;
	}
}


PHP;


        $this->assertSame($expected, $result);
    }


    public function testAnyOf() {
        $schemaData = json_decode(<<<'JSON'
{"anyOf": [
  {"properties": {
    "foo": {"enum": ["a"]},
    "bar": {"multipleOf": 3}
  }},
  {"properties": {
    "foo": {"enum": ["b"]},
    "bar": {"multipleOf": 5}
  }}
]}
JSON
        );

        $schema = Schema::import($schemaData);
        $builder = new PhpBuilder();
        $class = $builder->getClass($schema, 'Root');

        $result = '';
        foreach ($builder->getGeneratedClasses() as $class) {
            $result .= $class->class . "\n\n";
        }

        $expected = <<<'PHP'
/**
 * @method static \RootAnyOf0|\RootAnyOf1 import($data, Swaggest\JsonSchema\Context $options=null)
 */
class Root extends Swaggest\JsonSchema\Structure\ClassStructure {
	/**
	 * @param Swaggest\JsonSchema\Constraint\Properties|static $properties
	 * @param Swaggest\JsonSchema\Schema $ownerSchema
	 */
	public static function setUpProperties($properties, Swaggest\JsonSchema\Schema $ownerSchema)
	{
		$ownerSchema->anyOf[0] = \RootAnyOf0::schema();
		$ownerSchema->anyOf[1] = \RootAnyOf1::schema();
	}
}

class RootAnyOf0 extends Swaggest\JsonSchema\Structure\ClassStructure {
	public $foo;

	public $bar;

	/**
	 * @param Swaggest\JsonSchema\Constraint\Properties|static $properties
	 * @param Swaggest\JsonSchema\Schema $ownerSchema
	 */
	public static function setUpProperties($properties, Swaggest\JsonSchema\Schema $ownerSchema)
	{
		$properties->foo = new Swaggest\JsonSchema\Schema();
		$properties->foo->enum = array(
		    'a',
		);
		$properties->bar = new Swaggest\JsonSchema\Schema();
		$properties->bar->multipleOf = 3;
	}
}

class RootAnyOf1 extends Swaggest\JsonSchema\Structure\ClassStructure {
	public $foo;

	public $bar;

	/**
	 * @param Swaggest\JsonSchema\Constraint\Properties|static $properties
	 * @param Swaggest\JsonSchema\Schema $ownerSchema
	 */
	public static function setUpProperties($properties, Swaggest\JsonSchema\Schema $ownerSchema)
	{
		$properties->foo = new Swaggest\JsonSchema\Schema();
		$properties->foo->enum = array(
		    'b',
		);
		$properties->bar = new Swaggest\JsonSchema\Schema();
		$properties->bar->multipleOf = 5;
	}
}


PHP;


        $this->assertSame($expected, $result);
    }


    public function testAllOf() {
        // this schema will always fail because of conflicting allOf items
        $schemaData = json_decode(<<<'JSON'
{"allOf": [
  {"properties": {
    "foo": {"enum": ["a"]},
    "bar": {"multipleOf": 3}
  }},
  {"properties": {
    "foo": {"enum": ["b"]},
    "bar": {"multipleOf": 5}
  }}
]}
JSON
        );

        $schema = Schema::import($schemaData);
        $builder = new PhpBuilder();
        $class = $builder->getClass($schema, 'Root');

        $result = '';
        foreach ($builder->getGeneratedClasses() as $class) {
            $result .= $class->class . "\n\n";
        }

        $expected = <<<'PHP'
/**
 * @method static \RootAllOf0|\RootAllOf1 import($data, Swaggest\JsonSchema\Context $options=null)
 */
class Root extends Swaggest\JsonSchema\Structure\ClassStructure {
	/**
	 * @param Swaggest\JsonSchema\Constraint\Properties|static $properties
	 * @param Swaggest\JsonSchema\Schema $ownerSchema
	 */
	public static function setUpProperties($properties, Swaggest\JsonSchema\Schema $ownerSchema)
	{
		$ownerSchema->allOf[0] = \RootAllOf0::schema();
		$ownerSchema->allOf[1] = \RootAllOf1::schema();
	}
}

class RootAllOf0 extends Swaggest\JsonSchema\Structure\ClassStructure {
	public $foo;

	public $bar;

	/**
	 * @param Swaggest\JsonSchema\Constraint\Properties|static $properties
	 * @param Swaggest\JsonSchema\Schema $ownerSchema
	 */
	public static function setUpProperties($properties, Swaggest\JsonSchema\Schema $ownerSchema)
	{
		$properties->foo = new Swaggest\JsonSchema\Schema();
		$properties->foo->enum = array(
		    'a',
		);
		$properties->bar = new Swaggest\JsonSchema\Schema();
		$properties->bar->multipleOf = 3;
	}
}

class RootAllOf1 extends Swaggest\JsonSchema\Structure\ClassStructure {
	public $foo;

	public $bar;

	/**
	 * @param Swaggest\JsonSchema\Constraint\Properties|static $properties
	 * @param Swaggest\JsonSchema\Schema $ownerSchema
	 */
	public static function setUpProperties($properties, Swaggest\JsonSchema\Schema $ownerSchema)
	{
		$properties->foo = new Swaggest\JsonSchema\Schema();
		$properties->foo->enum = array(
		    'b',
		);
		$properties->bar = new Swaggest\JsonSchema\Schema();
		$properties->bar->multipleOf = 5;
	}
}


PHP;


        $this->assertSame($expected, $result);
    }


    public function testNot() {
        $schemaData = json_decode(<<<'JSON'
{"not":
  {"properties": {
    "foo": {"enum": ["a"]},
    "bar": {"multipleOf": 3}
  }
}}
JSON
        );

        $schema = Schema::import($schemaData);
        $builder = new PhpBuilder();
        $class = $builder->getClass($schema, 'Root');

        $result = '';
        foreach ($builder->getGeneratedClasses() as $class) {
            $result .= $class->class . "\n\n";
        }

        $expected = <<<'PHP'
/**
 * @method static  import($data, Swaggest\JsonSchema\Context $options=null)
 */
class Root extends Swaggest\JsonSchema\Structure\ClassStructure {
	/**
	 * @param Swaggest\JsonSchema\Constraint\Properties|static $properties
	 * @param Swaggest\JsonSchema\Schema $ownerSchema
	 */
	public static function setUpProperties($properties, Swaggest\JsonSchema\Schema $ownerSchema)
	{
		$ownerSchema->not = \RootNot::schema();
	}
}

class RootNot extends Swaggest\JsonSchema\Structure\ClassStructure {
	public $foo;

	public $bar;

	/**
	 * @param Swaggest\JsonSchema\Constraint\Properties|static $properties
	 * @param Swaggest\JsonSchema\Schema $ownerSchema
	 */
	public static function setUpProperties($properties, Swaggest\JsonSchema\Schema $ownerSchema)
	{
		$properties->foo = new Swaggest\JsonSchema\Schema();
		$properties->foo->enum = array(
		    'a',
		);
		$properties->bar = new Swaggest\JsonSchema\Schema();
		$properties->bar->multipleOf = 3;
	}
}


PHP;


        $this->assertSame($expected, $result);
    }

}