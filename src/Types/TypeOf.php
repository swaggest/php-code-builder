<?php

namespace Swaggest\PhpCodeBuilder\Types;

use Swaggest\PhpCodeBuilder\PhpAnyType;
use Swaggest\PhpCodeBuilder\PhpClassTraitInterface;
use Swaggest\PhpCodeBuilder\PhpTemplate;

class TypeOf extends PhpTemplate
{
    /** @var PhpAnyType */
    private $type;

    /** @var bool */
    private $renderPhpDoc;

    /**
     * TypeOf constructor.
     * @param PhpAnyType $type
     */
    public function __construct(PhpAnyType $type, $renderPhpDoc = false)
    {
        $this->renderPhpDoc = $renderPhpDoc;
        $this->type = $type;
    }

    protected function toString()
    {
        if ($this->type instanceof PhpClassTraitInterface) {
            return $this->type->getReference();
        } else {
            $res = $this->renderPhpDoc ? $this->type->renderPhpDocType() : $this->type->renderArgumentType();
            return $res;
        }
    }


}