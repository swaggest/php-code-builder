<?php

namespace Swaggest\PhpCodeBuilder\Tests\PHPUnit;

use Swaggest\PhpCodeBuilder\PhpClass;
use Swaggest\PhpCodeBuilder\PhpClassProperty;
use Swaggest\PhpCodeBuilder\PhpFlags;
use Swaggest\PhpCodeBuilder\PhpFunction;
use Swaggest\PhpCodeBuilder\PhpNamedVar;
use Swaggest\PhpCodeBuilder\PhpStdType;

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

        $expected = <<<'PHP'
class Uno
{
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
}