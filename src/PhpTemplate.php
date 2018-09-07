<?php

namespace Swaggest\PhpCodeBuilder;


use Swaggest\CodeBuilder\AbstractTemplate;

abstract class PhpTemplate extends AbstractTemplate
{
    public function indentLines($text)
    {
        return $this->padLines('    ', $text, false);
    }

}