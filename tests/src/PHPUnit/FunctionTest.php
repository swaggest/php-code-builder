<?php

namespace Swaggest\PhpCodeBuilder\Tests\PHPUnit;

use Swaggest\PhpCodeBuilder\PhpFunction;
use Swaggest\PhpCodeBuilder\PhpNamedVar;
use Swaggest\PhpCodeBuilder\PhpScalarType;

class FunctionTest extends \PHPUnit_Framework_TestCase
{
    public function testBasic()
    {
        $function = new PhpFunction('test', PhpFunction::VIS_PUBLIC);
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
            ->addArgument(new PhpNamedVar('arg1'))->addArgument(new PhpNamedVar('arg2', PhpScalarType::int()));
        $function->setBody(<<<PHP
echo \$arg1;
print_r(\$arg2);

PHP
);
        $expected = <<<PHP
function test(\$arg1, \$arg2)
{
	echo \$arg1;
	print_r(\$arg2);
}
PHP;

        $this->assertSame($expected, $function->__toString());

    }

}