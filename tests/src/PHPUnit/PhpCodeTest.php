<?php

namespace Swaggest\PhpCodeBuilder\Tests\PHPUnit;


use Swaggest\PhpCodeBuilder\PhpCode;

class PhpCodeTest extends \PHPUnit_Framework_TestCase
{
    public function testMakePhpConstantName()
    {
        $this->assertSame('A', PhpCode::makePhpConstantName('a'));
        $this->assertSame('ABC', PhpCode::makePhpConstantName('abc'));
        $this->assertSame('A_B_C', PhpCode::makePhpConstantName('a*b##c'));
        $this->assertSame('ABC', PhpCode::makePhpConstantName('_abc_'));
        $this->assertSame('ABC', PhpCode::makePhpConstantName('__abc__'));
        $this->assertSame('AB_C', PhpCode::makePhpConstantName('__AB__c__'));

        // Keyword would be invalid.
        $this->assertSame('_AS', PhpCode::makePhpConstantName('as'));

        // Leading numeric would be invalid.
        $this->assertSame('CONST_1_A', PhpCode::makePhpConstantName('1A'));

        // Empty would be invalid.
        $this->assertSame('CONST_CFCD20', PhpCode::makePhpConstantName('0'));
        $this->assertSame('CONST_B14A7B', PhpCode::makePhpConstantName('_'));
    }

    public function testFromCamelCase()
    {
        $this->assertSame('api_key', PhpCode::fromCamelCase('apiKey'));
        $this->assertSame('api_key', PhpCode::fromCamelCase('api_key'));
        $this->assertSame('a_bc_de_f', PhpCode::fromCamelCase('ABcDeF'));
        $this->assertSame('A_xx-', PhpCode::fromCamelCase('A_xx-'));

        $this->assertSame('abc_123_123_123_abc_def_ghi', PhpCode::fromCamelCase('abc_123_123_123_abcDefGhi'));
        $this->assertSame('_x-', PhpCode::fromCamelCase('_x-'));
    }

}
