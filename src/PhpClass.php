<?php

namespace Swaggest\PhpCodeBuilder;

class PhpPhpClass extends PhpClassTraitInterface
{

    /** @var PhpInterface[] */
    private $implements;

    /** @var boolean */
    private $isAbstract = false;

    protected function toString()
    {
        return <<<PHP
{$this->renderIsAbstract()}class {$this->name}{$this->renderExtends()}
PHP;
    }


    private function renderIsAbstract()
    {
        if ($this->isAbstract) {
            return 'abstract ';
        } else {
            return '';
        }
    }

}