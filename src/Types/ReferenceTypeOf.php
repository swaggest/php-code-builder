<?php

namespace Swaggest\PhpCodeBuilder\Types;

use Swaggest\PhpCodeBuilder\PhpAnyType;
use Swaggest\PhpCodeBuilder\PhpClass;
use Swaggest\PhpCodeBuilder\PhpClassTraitInterface;
use Swaggest\PhpCodeBuilder\PhpTemplate;

class ReferenceTypeOf extends PhpTemplate
{
    /** @var PhpClass */
    private $class;

    /**
     * TypeOf constructor.
     * @param PhpClassTraitInterface $class
     */
    public function __construct(PhpClassTraitInterface $class)
    {
        $this->class = $class;
    }

    protected function toString()
    {
        return $this->class->getReference();
    }

}