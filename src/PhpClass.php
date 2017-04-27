<?php

namespace Swaggest\PhpCodeBuilder;

class PhpClass extends PhpClassTraitInterface
{

    /** @var PhpInterface[] */
    private $implements;

    /** @var boolean */
    private $isAbstract = false;

    /** @var PhpClassProperty[] */
    private $properties = array();

    /** @var PhpFunction[] */
    private $methods = array();

    protected function toString()
    {
        $content = $this->renderProperties()
            . $this->renderMethods();

        $content = $this->indentLines(trim($content));

        return <<<PHP
{$this->renderIsAbstract()}class {$this->name}{$this->renderExtends()} {
$content
}
PHP;
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

    private function renderIsAbstract()
    {
        if ($this->isAbstract) {
            return 'abstract ';
        } else {
            return '';
        }
    }

}