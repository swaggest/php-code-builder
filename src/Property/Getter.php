<?php

namespace Swaggest\PhpCodeBuilder\Property;

use Swaggest\PhpCodeBuilder\PhpClassProperty;
use Swaggest\PhpCodeBuilder\PhpFlags;
use Swaggest\PhpCodeBuilder\PhpFunction;

class Getter extends PhpFunction
{
    /**
     * Getter constructor.
     * @param PhpClassProperty $property
     */
    public function __construct(PhpClassProperty $property)
    {
        $name = $property->getNamedVar()->getName();
        parent::__construct('get' . ucfirst($name), PhpFlags::VIS_PUBLIC);

        $this->skipCodeCoverage = true;

        $this->setResult($property->getNamedVar()->getType());
        $this->setBody(
            <<<PHP
return \$this->{$name};

PHP

        );
    }
}