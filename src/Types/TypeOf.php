<?php

namespace Swaggest\PhpCodeBuilder\Types;

use Swaggest\PhpCodeBuilder\PhpAnyType;
use Swaggest\PhpCodeBuilder\PhpClassTraitInterface;
use Swaggest\PhpCodeBuilder\PhpTemplate;

class TypeOf extends PhpTemplate
{
    /** @var PhpAnyType */
    private $type;

    /**
     * TypeOf constructor.
     * @param PhpAnyType $type
     */
    public function __construct(PhpAnyType $type)
    {
        $this->type = $type;
    }

    protected function toString()
    {
        if ($this->type instanceof PhpClassTraitInterface) {
            return $this->type->getReference();
        } else {
            return $this->type;
        }
    }


}