<?php

namespace Swaggest\PhpCodeBuilder;


class PhpInterface extends PhpClassTraitInterface
{
    protected function toString()
    {
        return <<<PHP
interface {$this->name}{$this->renderExtends()} {
}
PHP;

    }


}