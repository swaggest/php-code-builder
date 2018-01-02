<?php

namespace Swaggest\PhpCodeBuilder\Traits;


use Swaggest\PhpCodeBuilder\PhpDoc;

trait PhpDocable
{
    /** @var PhpDoc */
    private $phpDoc;

    public function getPhpDoc()
    {
        if (null === $this->phpDoc) {
            $this->phpDoc = new PhpDoc();
        }
        return $this->phpDoc;
    }

}