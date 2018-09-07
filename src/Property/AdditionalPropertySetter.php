<?php

namespace Swaggest\PhpCodeBuilder\Property;


use Swaggest\PhpCodeBuilder\PhpAnyType;
use Swaggest\PhpCodeBuilder\PhpFlags;
use Swaggest\PhpCodeBuilder\PhpFunction;
use Swaggest\PhpCodeBuilder\PhpNamedVar;
use Swaggest\PhpCodeBuilder\PhpStdType;

class AdditionalPropertySetter extends PhpFunction
{
    public function __construct(PhpAnyType $type)
    {
        parent::__construct('setAdditionalPropertyValue', PhpFlags::VIS_PUBLIC);

        $this->addArgument(new PhpNamedVar('name', PhpStdType::string()));
        $this->addArgument(new PhpNamedVar('value', $type));

        $this->skipCodeCoverage = true;

        $this->setResult(PhpStdType::tSelf());
        $this->setBody(
            <<<'PHP'
$this->addAdditionalPropertyName($name);
$this->{$name} = $value;
return $this;

PHP
        );
    }
}