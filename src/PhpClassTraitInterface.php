<?php

namespace Swaggest\PhpCodeBuilder;


use Swaggest\PhpCodeBuilder\Traits\Description;

abstract class PhpClassTraitInterface extends PhpTemplate implements PhpAnyType
{
    use Description;

    protected $name;
    private $namespace;

    /** @var PhpClass */
    private $extends;

    /** @var PhpDoc */
    private $phpDoc;

    /**
     * @return PhpDoc
     */
    public function getPhpDoc()
    {
        if ($this->phpDoc === null) {
            $this->phpDoc = new PhpDoc();
        }
        return $this->phpDoc;
    }

    protected function renderHeadComment()
    {
        if ($this->description) {
            $this->getPhpDoc()->prepend('', $this->description);
        }
        return $this->phpDoc;
    }

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

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return PhpClassTraitInterface
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    public function setFullyQualifiedName($fqn)
    {
        $path = explode('\\', $fqn);
        $this->name = array_pop($path);
        $this->namespace = implode('\\', $path);
        return $this;
    }

    /**
     * @param mixed $namespace
     * @return PhpClassTraitInterface
     */
    public function setNamespace($namespace)
    {
        $this->namespace = $namespace;
        return $this;
    }

    /**
     * @return PhpClass
     */
    public function getExtends()
    {
        return $this->extends;
    }

    /**
     * @param PhpClass $extends
     * @return PhpClassTraitInterface
     */
    public function setExtends(PhpClass $extends)
    {
        $this->extends = $extends;
        return $this;
    }

    /**
     * Create instance by fully qualified name
     *
     * @param string $fqn
     * @return static
     */
    public static function byFQN($fqn)
    {
        $c = new static;
        $c->setFullyQualifiedName($fqn);
        return $c;
    }

}