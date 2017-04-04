<?php

namespace Swaggest\PhpCodeBuilder\Types;

use Swaggest\PhpCodeBuilder\PhpAnyType;
use Swaggest\PhpCodeBuilder\PhpTemplate;

class PhpDocTypeOf extends PhpTemplate
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
        return $this->type->renderPhpDocType();
    }

}