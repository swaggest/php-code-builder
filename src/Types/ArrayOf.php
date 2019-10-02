<?php

namespace Swaggest\PhpCodeBuilder\Types;


use Swaggest\PhpCodeBuilder\PhpAnyType;
use Swaggest\PhpCodeBuilder\PhpStdType;

class ArrayOf implements PhpAnyType
{
    /** @var PhpAnyType */
    private $type;

    /**
     * @return PhpAnyType
     */
    public function getType()
    {
        return $this->type;
    }

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
        } elseif ($this->type === PhpStdType::mixed()) {
            return 'array';
        } else {
            return $this->type->renderPhpDocType() . '[]';
        }
    }


}