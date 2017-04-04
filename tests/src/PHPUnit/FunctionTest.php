<?php

namespace Swaggest\PhpCodeBuilder\Tests\PHPUnit;

use Swaggest\PhpCodeBuilder\PhpFlags;
use Swaggest\PhpCodeBuilder\PhpFunction;
use Swaggest\PhpCodeBuilder\PhpNamedVar;
use Swaggest\PhpCodeBuilder\PhpStdType;

class FunctionTest extends \PHPUnit_Framework_TestCase
{
    public function testBasic()
    {
        $function = new PhpFunction('test', PhpFlags::VIS_PUBLIC);
        $expected = <<<PHP
public function test()
{
}


PHP;

        $this->assertSame($expected, $function->__toString());
    }

    public function testArguments()
    {
        $function = new PhpFunction('test');
        $function
            ->addArgument(new PhpNamedVar('arg1'))->addArgument(new PhpNamedVar('arg2', PhpStdType::int()));
        $function->setBody(<<<'PHP'
echo $arg1;
print_r($arg2);

PHP
);
        $expected = <<<'PHP'
/**
 * @param $arg1
 * @param int $arg2
 */
function test($arg1,  $arg2)
{
	echo $arg1;
	print_r($arg2);
}


PHP;

        $this->assertSame($expected, $function->__toString());

    }

}