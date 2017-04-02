<?php

namespace Swaggest\PhpCodeBuilder;


abstract class PhpClassTraitInterface extends PhpTemplate implements PhpAnyType
{
    protected $name;
    private $namespace;

    /** @var PhpPhpClass */
    private $extends;

    protected function renderExtends()
    {
        if ($this->extends) {
            return <<<PHP
 extends {$this->extends->getReference()}
PHP;
        }
        return '';
    }

    public function getReference()
    {
        if ($file = PhpFile::getCurrentPhpFile()) {
            return $file->getNamespaces()->getReference($this->getFullyQualifiedName());
        } else {
            return $this->getFullyQualifiedName();
        }
    }

    public function getFullyQualifiedName()
    {
        return $this->namespace . '\\' . $this->name;
    }

    public function renderArgumentType()
    {
        return $this->getReference();
    }

    public function renderPhpDocType()
    {
        return $this->getReference();
    }


}