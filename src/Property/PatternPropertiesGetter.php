<?php

namespace Swaggest\PhpCodeBuilder\Property;


use Swaggest\PhpCodeBuilder\PhpAnyType;
use Swaggest\PhpCodeBuilder\PhpCode;
use Swaggest\PhpCodeBuilder\PhpConstant;
use Swaggest\PhpCodeBuilder\PhpFlags;
use Swaggest\PhpCodeBuilder\PhpFunction;
use Swaggest\PhpCodeBuilder\Types\ArrayOf;

class PatternPropertiesGetter extends PhpFunction
{
    public function __construct(PhpConstant $patternConst, PhpAnyType $type)
    {
        $name = PhpCode::makePhpName($patternConst->getValue(), false);
        parent::__construct('get' . $name . 'Values', PhpFlags::VIS_PUBLIC);

        $this->skipCodeCoverage = true;

        $this->setResult(new ArrayOf($type));
        $this->setBody(
            <<<PHP
\$result = array();
if (!\$names = \$this->getPatternPropertyNames(self::{$patternConst->getName()})) {
    return \$result;
}
foreach (\$names as \$name) {
    \$result[\$name] = \$this->\$name;
}
return \$result;

PHP
        );
    }
}