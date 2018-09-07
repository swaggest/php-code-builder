<?php

namespace Swaggest\PhpCodeBuilder\Property;


use Swaggest\PhpCodeBuilder\PhpAnyType;
use Swaggest\PhpCodeBuilder\PhpFlags;
use Swaggest\PhpCodeBuilder\PhpFunction;
use Swaggest\PhpCodeBuilder\Types\ArrayOf;

class AdditionalPropertiesGetter extends PhpFunction
{
    public function __construct(PhpAnyType $type)
    {
        parent::__construct('getAdditionalPropertyValues', PhpFlags::VIS_PUBLIC);

        $this->skipCodeCoverage = true;

        $this->setResult(new ArrayOf($type));
        $this->setBody(
            <<<'PHP'
$result = array();
if (!$names = $this->getAdditionalPropertyNames()) {
    return $result;
}
foreach ($names as $name) {
    $result[$name] = $this->$name;
}
return $result;

PHP
        );
    }
}