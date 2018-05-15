<?php

namespace Swaggest\PhpCodeBuilder\Tests\PHPUnit\JsonSchema;

use Swaggest\JsonSchema\Schema;
use Swaggest\PhpCodeBuilder\JsonSchema\PhpBuilder;

class SchemaTest extends \PHPUnit_Framework_TestCase
{
    public function testProperties()
    {
        $anotherSchema = Schema::object()
            ->setProperty('hello', Schema::boolean())
            ->setProperty('world', Schema::string());


        $schema = Schema::object()
            ->setProperty('sampleInt', Schema::integer())
            ->setProperty('sampleBool', Schema::boolean())
            ->setProperty('sampleString', Schema::string())
            ->setProperty('sampleNumber', Schema::number())
        ;
        $schema
            ->setProperty('sampleSelf', $schema)
            ->setProperty('another', $anotherSchema)
        ;


        $builder = new PhpBuilder();
        $builder->buildSetters = true;

        $type = $builder->getType($schema);

        $index = 0;

        foreach ($builder->getGeneratedClasses() as $class) {
            $class->class->setName('Beech' . ++$index);
        }

        $expectedClasses = <<<'PHP'
class Beech1 extends Swaggest\JsonSchema\Structure\ClassStructure {
	/** @var int */
	public $sampleInt;

	/** @var bool */
	public $sampleBool;

	/** @var string */
	public $sampleString;

	/** @var float */
	public $sampleNumber;

	/** @var \Beech1 */
	public $sampleSelf;

	/** @var \Beech2 */
	public $another;

	/**
	 * @param Swaggest\JsonSchema\Constraint\Properties|static $properties
	 * @param Swaggest\JsonSchema\Schema $ownerSchema
	 */
	public static function setUpProperties($properties, Swaggest\JsonSchema\Schema $ownerSchema)
	{
		$properties->sampleInt = Swaggest\JsonSchema\Schema::integer();
		$properties->sampleBool = Swaggest\JsonSchema\Schema::boolean();
		$properties->sampleString = Swaggest\JsonSchema\Schema::string();
		$properties->sampleNumber = Swaggest\JsonSchema\Schema::number();
		$properties->sampleSelf = \Beech1::schema();
		$properties->another = \Beech2::schema();
		$ownerSchema->type = 'object';
	}

	/**
	 * @param int $sampleInt
	 * @return $this
	 * @codeCoverageIgnoreStart
	 */
	public function setSampleInt($sampleInt)
	{
		$this->sampleInt = $sampleInt;
		return $this;
	}
	/** @codeCoverageIgnoreEnd */

	/**
	 * @param bool $sampleBool
	 * @return $this
	 * @codeCoverageIgnoreStart
	 */
	public function setSampleBool($sampleBool)
	{
		$this->sampleBool = $sampleBool;
		return $this;
	}
	/** @codeCoverageIgnoreEnd */

	/**
	 * @param string $sampleString
	 * @return $this
	 * @codeCoverageIgnoreStart
	 */
	public function setSampleString($sampleString)
	{
		$this->sampleString = $sampleString;
		return $this;
	}
	/** @codeCoverageIgnoreEnd */

	/**
	 * @param float $sampleNumber
	 * @return $this
	 * @codeCoverageIgnoreStart
	 */
	public function setSampleNumber($sampleNumber)
	{
		$this->sampleNumber = $sampleNumber;
		return $this;
	}
	/** @codeCoverageIgnoreEnd */

	/**
	 * @param \Beech1 $sampleSelf
	 * @return $this
	 * @codeCoverageIgnoreStart
	 */
	public function setSampleSelf(\Beech1 $sampleSelf)
	{
		$this->sampleSelf = $sampleSelf;
		return $this;
	}
	/** @codeCoverageIgnoreEnd */

	/**
	 * @param \Beech2 $another
	 * @return $this
	 * @codeCoverageIgnoreStart
	 */
	public function setAnother(\Beech2 $another)
	{
		$this->another = $another;
		return $this;
	}
	/** @codeCoverageIgnoreEnd */
}
class Beech2 extends Swaggest\JsonSchema\Structure\ClassStructure {
	/** @var bool */
	public $hello;

	/** @var string */
	public $world;

	/**
	 * @param Swaggest\JsonSchema\Constraint\Properties|static $properties
	 * @param Swaggest\JsonSchema\Schema $ownerSchema
	 */
	public static function setUpProperties($properties, Swaggest\JsonSchema\Schema $ownerSchema)
	{
		$properties->hello = Swaggest\JsonSchema\Schema::boolean();
		$properties->world = Swaggest\JsonSchema\Schema::string();
		$ownerSchema->type = 'object';
	}

	/**
	 * @param bool $hello
	 * @return $this
	 * @codeCoverageIgnoreStart
	 */
	public function setHello($hello)
	{
		$this->hello = $hello;
		return $this;
	}
	/** @codeCoverageIgnoreEnd */

	/**
	 * @param string $world
	 * @return $this
	 * @codeCoverageIgnoreStart
	 */
	public function setWorld($world)
	{
		$this->world = $world;
		return $this;
	}
	/** @codeCoverageIgnoreEnd */
}

PHP;

        $actualClasses = '';
        foreach ($builder->getGeneratedClasses() as $class) {
            $actualClasses .= $class->class . "\n";
        }

        $this->assertSame($expectedClasses, $actualClasses);
        $this->assertSame('\Beech1', $type->renderPhpDocType());
    }


    public function testSimple()
    {
        $builder = new PhpBuilder();
        $this->assertSame('int', $builder->getType(Schema::integer())->renderPhpDocType());
        $this->assertSame('float', $builder->getType(Schema::number())->renderPhpDocType());
        $this->assertSame('string', $builder->getType(Schema::string())->renderPhpDocType());
        $this->assertSame('bool', $builder->getType(Schema::boolean())->renderPhpDocType());
        $this->assertSame('array', $builder->getType(Schema::arr())->renderPhpDocType());
        //$this->assertSame('object', $builder->getType(Schema::object())->renderPhpDocType());
        $this->assertSame('null', $builder->getType(Schema::null())->renderPhpDocType());
    }

}