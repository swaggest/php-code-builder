<?php

namespace Swaggest\PhpCodeBuilder;


class PhpInterface extends PhpClassTraitInterface
{
    protected function toString()
    {
        return <<<PHP
{$this->renderHeadComment()}interface {$this->name}{$this->renderExtends()} {
}
PHP;

    }


}