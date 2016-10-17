<?php

namespace Swaggest\GoCodeBuilder\Tests;


use Swaggest\GoCodeBuilder\Imports;

class ImportTest extends \PHPUnit_Framework_TestCase
{
    public function testImports()
    {
        $imports = new Imports();
        $imports->add('import1');
        $imports->add('import2', 'i2');
        $imports->add('import1');

        $expected = <<<GO
import (
	"import1"
	i2 "import2"
)
GO;
        $this->assertSame($expected, $imports->render());
    }

}