<?php

namespace Swaggest\PhpCodeBuilder\Tests\PHPUnit;

use Swaggest\PhpCodeBuilder\Exception;
use Swaggest\PhpCodeBuilder\PhpClass;
use Swaggest\PhpCodeBuilder\PhpClassProperty;
use Swaggest\PhpCodeBuilder\PhpFlags;
use Swaggest\PhpCodeBuilder\PhpFunction;
use Swaggest\PhpCodeBuilder\PhpNamedVar;
use Swaggest\PhpCodeBuilder\PhpStdType;
use Swaggest\PhpCodeBuilder\PhpTrait;

class ClassTest extends \PHPUnit_Framework_TestCase
{
    public function testBasic()
    {
        $class = new PhpClass();
        $class->setName('Uno');
        $class->setNamespace('My\\Test');

        $class->addProperty(new PhpClassProperty('some', PhpStdType::string(), PhpFlags::VIS_PRIVATE));

        $class->addProperty(
            (new PhpClassProperty(
                'someInt',
                PhpStdType::int(),
                PhpFlags::VIS_PROTECTED
            ))->setDescription('A sample int property')
        );

        $class->addMethod(
            (new PhpFunction('process', PhpFlags::VIS_PRIVATE))
                ->addArgument(
                    (new PhpNamedVar('hello', $class))
                        ->setDescription('world')
                )
                ->setResult($class)
                ->setDescription('A sample method')
        );

        $class->addTrait(
            (new PhpTrait(
                '\Foo\Bar'
            ))->setDescription('A sample trait usage')
        );

        $expected = <<<'PHP'
class Uno
{
    /**
     * A sample trait usage
     */
    use \Foo\Bar;

    /** @var string */
    private $some;

    /** @var int A sample int property */
    protected $someInt;

    /**
     * A sample method
     * @param My\Test\Uno $hello world
     * @return My\Test\Uno
     */
    private function process(My\Test\Uno $hello)
    {
    }
}
PHP;
        $this->assertSame($expected, (string)$class);
    }

    public function testInitTrait()
    {
        $trait = new PhpTrait('\Foo\Bar');

        $this->assertInstanceOf(PhpTrait::class, $trait, 'Initiatet correct Class');
        $this->assertSame($trait->getName(), '\Foo\Bar', 'Saved the correct name of the trait');
    }

    public function testTraitOutput()
    {
        $trait = new PhpTrait('\Foo\Bar');
        $this->assertSame($trait->__toString(), <<<'PHP'
use \Foo\Bar;


PHP
        );

        $trait->setDescription('A sample trait.');
        $this->assertSame($trait->__toString(), <<<'PHP'
/**
 * A sample trait.
 */
use \Foo\Bar;


PHP
        );
    }

    public function testThrowExceptionOnDuplicateTrait()
    {
        $this->setExpectedException(Exception::class);
        $class = new PhpClass();
        $class->addTrait(new PhpTrait('\Foo\Bar'));
        $class->addTrait(new PhpTrait('\Foo\Bar'));
    }
}