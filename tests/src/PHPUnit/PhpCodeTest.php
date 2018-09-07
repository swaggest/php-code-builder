<?php

namespace Swaggest\PhpCodeBuilder\Tests\PHPUnit;


use Swaggest\PhpCodeBuilder\PhpCode;

class PhpCodeTest extends \PHPUnit_Framework_TestCase
{
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