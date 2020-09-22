<?php

namespace Swaggest\PhpCodeBuilder\Tests\PHPUnit\JsonSchema;


use Swaggest\JsonSchema\Schema;
use Swaggest\PhpCodeBuilder\JsonSchema\PhpBuilder;

class AdvancedTest extends \PHPUnit_Framework_TestCase
{
    public function testOneOf()
    {
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
 * @method static \RootOneOf0|\RootOneOf1 import($data, Swaggest\JsonSchema\Context $options = null)
 */
class Root extends Swaggest\JsonSchema\Structure\ClassStructure
{
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

/**
 * @property mixed $bar
 */
class RootOneOf0 extends Swaggest\JsonSchema\Structure\ClassStructure
{
    /** @var mixed */
    public $foo;

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

/**
 * @property mixed $bar
 */
class RootOneOf1 extends Swaggest\JsonSchema\Structure\ClassStructure
{
    /** @var mixed */
    public $foo;

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


    public function testAnyOf()
    {
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
    }
}

/**
 * @property mixed $bar
 */
class RootAnyOf0 extends Swaggest\JsonSchema\Structure\ClassStructure
{
    /** @var mixed */
    public $foo;

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

/**
 * @property mixed $bar
 */
class RootAnyOf1 extends Swaggest\JsonSchema\Structure\ClassStructure
{
    /** @var mixed */
    public $foo;

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


    public function testAllOf()
    {
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
 * @method static \RootAllOf0|\RootAllOf1 import($data, Swaggest\JsonSchema\Context $options = null)
 */
class Root extends Swaggest\JsonSchema\Structure\ClassStructure
{
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

/**
 * @property mixed $bar
 */
class RootAllOf0 extends Swaggest\JsonSchema\Structure\ClassStructure
{
    /** @var mixed */
    public $foo;

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

/**
 * @property mixed $bar
 */
class RootAllOf1 extends Swaggest\JsonSchema\Structure\ClassStructure
{
    /** @var mixed */
    public $foo;

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


    public function testNot()
    {
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
 * @method static mixed import($data, Swaggest\JsonSchema\Context $options = null)
 */
class Root extends Swaggest\JsonSchema\Structure\ClassStructure
{
    /**
     * @param Swaggest\JsonSchema\Constraint\Properties|static $properties
     * @param Swaggest\JsonSchema\Schema $ownerSchema
     */
    public static function setUpProperties($properties, Swaggest\JsonSchema\Schema $ownerSchema)
    {
        $ownerSchema->not = \RootNot::schema();
    }
}

/**
 * @property mixed $bar
 */
class RootNot extends Swaggest\JsonSchema\Structure\ClassStructure
{
    /** @var mixed */
    public $foo;

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


    public function testPatternProperties()
    {
        $schemaData = json_decode(<<<'JSON'
{
  "type": "object",
  "additionalProperties": false,
  "patternProperties": {
    "^x-": {
      "$ref": "#/definitions/x"
    },
    "^zed-": {
      "$ref": "#/definitions/z"
    }
  },
  "definitions": {
    "x": {
      "oneOf": [
        {
          "type": "null"
        },
        {
          "type": "number"
        },
        {
          "type": "boolean"
        },
        {
          "type": "string"
        },
        {
          "type": "object"
        },
        {
          "type": "array"
        }
      ]
    },
    "z": {
        "type": "string"
    }
  }
}
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
 * @method static null[]|float[]|bool[]|string[]|mixed[]|array[]|string[] import($data, Swaggest\JsonSchema\Context $options = null)
 */
class Root extends Swaggest\JsonSchema\Structure\ClassStructure
{
    const X_PROPERTY_PATTERN = '^x-';

    const ZED_PROPERTY_PATTERN = '^zed-';

    /**
     * @param Swaggest\JsonSchema\Constraint\Properties|static $properties
     * @param Swaggest\JsonSchema\Schema $ownerSchema
     */
    public static function setUpProperties($properties, Swaggest\JsonSchema\Schema $ownerSchema)
    {
        $ownerSchema->type = Swaggest\JsonSchema\Schema::OBJECT;
        $ownerSchema->additionalProperties = false;
        $x = new Swaggest\JsonSchema\Schema();
        $x->oneOf[0] = Swaggest\JsonSchema\Schema::null();
        $x->oneOf[1] = Swaggest\JsonSchema\Schema::number();
        $x->oneOf[2] = Swaggest\JsonSchema\Schema::boolean();
        $x->oneOf[3] = Swaggest\JsonSchema\Schema::string();
        $x->oneOf[4] = Swaggest\JsonSchema\Schema::object();
        $x->oneOf[5] = Swaggest\JsonSchema\Schema::arr();
        $x->setFromRef('#/definitions/x');
        $ownerSchema->setPatternProperty('^x-', $x);
        $zed = Swaggest\JsonSchema\Schema::string();
        $zed->setFromRef('#/definitions/z');
        $ownerSchema->setPatternProperty('^zed-', $zed);
    }

    /**
     * @return null[]|float[]|bool[]|string[]|mixed[]|array[]
     * @codeCoverageIgnoreStart
     */
    public function getXValues()
    {
        $result = array();
        if (!$names = $this->getPatternPropertyNames(self::X_PROPERTY_PATTERN)) {
            return $result;
        }
        foreach ($names as $name) {
            $result[$name] = $this->$name;
        }
        return $result;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param string $name
     * @param null|float|bool|string|array $value
     * @return self
     * @throws Swaggest\JsonSchema\InvalidValue
     * @codeCoverageIgnoreStart
     */
    public function setXValue($name, $value)
    {
        if (!preg_match(Swaggest\JsonSchema\Helper::toPregPattern(self::X_PROPERTY_PATTERN), $name)) {
            throw new StringException('Pattern mismatch', Swaggest\JsonSchema\Exception\StringException::PATTERN_MISMATCH);
        }
        $this->addPatternPropertyName(self::X_PROPERTY_PATTERN, $name);
        $this->{$name} = $value;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @return string[]
     * @codeCoverageIgnoreStart
     */
    public function getZedValues()
    {
        $result = array();
        if (!$names = $this->getPatternPropertyNames(self::ZED_PROPERTY_PATTERN)) {
            return $result;
        }
        foreach ($names as $name) {
            $result[$name] = $this->$name;
        }
        return $result;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param string $name
     * @param string $value
     * @return self
     * @throws Swaggest\JsonSchema\InvalidValue
     * @codeCoverageIgnoreStart
     */
    public function setZedValue($name, $value)
    {
        if (!preg_match(Swaggest\JsonSchema\Helper::toPregPattern(self::ZED_PROPERTY_PATTERN), $name)) {
            throw new StringException('Pattern mismatch', Swaggest\JsonSchema\Exception\StringException::PATTERN_MISMATCH);
        }
        $this->addPatternPropertyName(self::ZED_PROPERTY_PATTERN, $name);
        $this->{$name} = $value;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */
}


PHP;


        $this->assertSame($expected, $result);

    }


    public function testClassPropertyDefaultsActivated()
    {
        $schemaData = json_decode(<<<'JSON'
{
    "properties": {
        "stringDefault": {
            "type": "string",
            "default": "list"
        },
        "booleanDefault": {
            "type": "boolean",
            "default": false
        },
        "integerDefault": {
            "type": "integer",
            "default": 1
        },
        "arrayDefault": {
            "type": "array",
            "default": []
        },
        "arrayNullableDefault": {
            "type": ["null","array"],
            "default": null
        },
        "objectDefault": {
            "type": "object",
            "default": {"key":"val"}
        },
        "arrayOfObjectsDefault": {
            "type": "array",
            "default": [{"key":"val"},{"key":"val"}]
        },
        "noDefault": {
            "type": "string"
        }
    }
}
JSON
        );

        $schema = Schema::import($schemaData);
        $builder = new PhpBuilder();
        $builder->buildSetters = true;
        $builder->declarePropertyDefaults = true;
        $class = $builder->getClass($schema, 'Root');

        $result = '';
        foreach ($builder->getGeneratedClasses() as $class) {
            $result .= $class->class . "\n\n";
        }

        $expected = <<<'PHP'
/**
 * @property null|array $arrayNullableDefault
 */
class Root extends Swaggest\JsonSchema\Structure\ClassStructure
{
    /** @var string */
    public $stringDefault = 'list';

    /** @var bool */
    public $booleanDefault = false;

    /** @var int */
    public $integerDefault = 1;

    /** @var array */
    public $arrayDefault = [];

    /** @var mixed */
    public $objectDefault;

    /** @var array */
    public $arrayOfObjectsDefault;

    /** @var string */
    public $noDefault;

    /**
     * @param Swaggest\JsonSchema\Constraint\Properties|static $properties
     * @param Swaggest\JsonSchema\Schema $ownerSchema
     */
    public static function setUpProperties($properties, Swaggest\JsonSchema\Schema $ownerSchema)
    {
        $properties->stringDefault = Swaggest\JsonSchema\Schema::string();
        $properties->stringDefault->default = "list";
        $properties->booleanDefault = Swaggest\JsonSchema\Schema::boolean();
        $properties->booleanDefault->default = false;
        $properties->integerDefault = Swaggest\JsonSchema\Schema::integer();
        $properties->integerDefault->default = 1;
        $properties->arrayDefault = Swaggest\JsonSchema\Schema::arr();
        $properties->arrayDefault->default = [];
        $properties->arrayNullableDefault = (new Swaggest\JsonSchema\Schema())->setType([Swaggest\JsonSchema\Schema::NULL, Swaggest\JsonSchema\Schema::_ARRAY]);
        $properties->arrayNullableDefault->default = NULL;
        $properties->objectDefault = Swaggest\JsonSchema\Schema::object();
        $properties->objectDefault->default = (object)[
            'key' => 'val',
        ];
        $properties->arrayOfObjectsDefault = Swaggest\JsonSchema\Schema::arr();
        $properties->arrayOfObjectsDefault->default = [
            (object)[
                'key' => 'val',
            ],
            (object)[
                'key' => 'val',
            ],
        ];
        $properties->noDefault = Swaggest\JsonSchema\Schema::string();
    }

    /**
     * @param string $stringDefault
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setStringDefault($stringDefault)
    {
        $this->stringDefault = $stringDefault;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param bool $booleanDefault
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setBooleanDefault($booleanDefault)
    {
        $this->booleanDefault = $booleanDefault;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param int $integerDefault
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setIntegerDefault($integerDefault)
    {
        $this->integerDefault = $integerDefault;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param array $arrayDefault
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setArrayDefault($arrayDefault)
    {
        $this->arrayDefault = $arrayDefault;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param null|array $arrayNullableDefault
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setArrayNullableDefault($arrayNullableDefault)
    {
        $this->arrayNullableDefault = $arrayNullableDefault;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param mixed $objectDefault
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setObjectDefault($objectDefault)
    {
        $this->objectDefault = $objectDefault;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param array $arrayOfObjectsDefault
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setArrayOfObjectsDefault($arrayOfObjectsDefault)
    {
        $this->arrayOfObjectsDefault = $arrayOfObjectsDefault;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param string $noDefault
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setNoDefault($noDefault)
    {
        $this->noDefault = $noDefault;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */
}


PHP;

        $this->assertSame($expected, $result);
    }

    public function testClassPropertyDefaultsDeactivated()
    {
        $schemaData = json_decode(<<<'JSON'
{
    "properties": {
        "stringDefault": {
            "type": "string",
            "default": "list"
        },
        "booleanDefault": {
            "type": "boolean",
            "default": false
        },
        "integerDefault": {
            "type": "integer",
            "default": 1
        },
        "arrayDefault": {
            "type": "array",
            "default": []
        },
        "noDefault": {
            "type": "string"
        }
    }
}
JSON
        );

        $schema = Schema::import($schemaData);
        $builder = new PhpBuilder();
        $builder->buildSetters = true;
        $class = $builder->getClass($schema, 'Root');

        $result = '';
        foreach ($builder->getGeneratedClasses() as $class) {
            $result .= $class->class . "\n\n";
        }

        $expected = <<<'PHPfragment'
    /** @var string */
    public $stringDefault;

    /** @var bool */
    public $booleanDefault;

    /** @var int */
    public $integerDefault;

    /** @var array */
    public $arrayDefault;

    /** @var string */
    public $noDefault;
PHPfragment;

        $this->assertContains($expected, $result);
    }

    public function testBuildingAdditionalPropertyMethodsOnTrue()
    {
        $schemaData = json_decode(<<<'JSON'
{
  "type": "object",
  "additionalProperties": true
}
JSON
        );

        // Keeping the old behavior
        $schema = Schema::import($schemaData);
        $builder = new PhpBuilder();
        $class = $builder->getClass($schema, 'Root');

        $result = '';
        foreach ($builder->getGeneratedClasses() as $class) {
            $result .= $class->class . "\n\n";
        }

        $expected = file_get_contents(__DIR__ . '/../../../resources/JsonSchema/AdvancedTest/' . __FUNCTION__ . '-old-behavior.txt');

        $this->assertSame($expected, $result, 'Getter and setter not created (old behavior - flag: false)');

        // Testing the new behavior with setted flag
        $schema = Schema::import($schemaData);
        $builder = new PhpBuilder();
        $builder->buildAdditionalPropertyMethodsOnTrue = true;
        $class = $builder->getClass($schema, 'Root');

        $result = '';
        foreach ($builder->getGeneratedClasses() as $class) {
            $result .= $class->class . "\n\n";
        }

        $expected = file_get_contents(__DIR__ . '/../../../resources/JsonSchema/AdvancedTest/' . __FUNCTION__ . '-new-behavior.txt');

        $this->assertSame($expected, $result, 'Getter and setter created (new behavior - flag: true)');
    }
}