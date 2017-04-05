<?php

namespace Swaggest\PhpCodeBuilder\Types;


use Swaggest\PhpCodeBuilder\PhpAnyType;

class ArrayOf implements PhpAnyType
{
    /** @var PhpAnyType */
    private $type;

    /**
     * ArrayOf constructor.
     * @param PhpAnyType $type
     */
    public function __construct(PhpAnyType $type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function renderArgumentType()
    {
        return '';
    }

    /**
     * @return string
     */
    public function renderPhpDocType()
    {
        if ($this->type instanceof OrType) {
            return $this->type->renderArrayPhpDocType();
        } else {
            return $this->type->renderPhpDocType() . '[]';
        }
    }


}