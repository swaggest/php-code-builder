<?php

namespace Swaggest\PhpCodeBuilder;

class PhpClass extends PhpClassTraitInterface
{
    /** @var PhpInterface[] */
    private $implements;


    public function addImplements(PhpInterface $implements)
    {
        $this->implements[] = $implements;
        return $this;
    }

    /** @var boolean */
    private $isAbstract = false;

    /** @var PhpClassProperty[] */
    private $properties = array();

    /**
     * @return PhpClassProperty[]
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /** @var PhpFunction[] */
    private $methods = array();

    /** @var PhpConstant[] */
    private $constants = array();

    private function renderImplements()
    {
        if ($this->implements) {
            $implements = '';
            foreach ($this->implements as $implement) {
                $implements .= $implement->getReference() . ', ';
            }
            $implements = substr($implements, 0, -2);
            return <<<PHP
 implements {$implements}
PHP;
        }
        return '';

    }

    protected function toString()
    {
        $content = $this->renderConstants() . $this->renderProperties()
            . $this->renderMethods();

        $content = $this->indentLines(trim($content));

        return <<<PHP
{$this->renderHeadComment()}{$this->renderIsAbstract()}class {$this->name}{$this->renderExtends()}{$this->renderImplements()} {
$content
}
PHP;
    }

    private function renderConstants()
    {
        $result = '';
        foreach ($this->constants as $name => $constant) {
            $result .= $constant->render();
        }
        return $result;
    }

    private function renderProperties()
    {
        $result = '';
        foreach ($this->properties as $property) {
            $result .= $property->render();
        }
        return $result;
    }

    private function renderMethods()
    {
        $result = '';
        foreach ($this->methods as $method) {
            $result .= $method->render();
        }
        return $result;
    }

    public function addProperty(PhpClassProperty $property)
    {
        $this->properties[] = $property;
        return $this;
    }

    public function addMethod(PhpFunction $function)
    {
        $this->methods[] = $function;
        return $this;
    }

    public function addConstant(PhpConstant $constant)
    {
        if (array_key_exists($constant->getName(), $this->constants)) {
            if ($this->constants[$constant->getName()]->getValue() !== $constant->getValue()) {
                throw new Exception('Duplicate const with different value');
            }
        } else {
            $this->constants[$constant->getName()] = $constant;
        }
        return $this;
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