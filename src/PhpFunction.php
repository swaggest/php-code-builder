<?php

namespace Swaggest\PhpCodeBuilder;


class PhpFunction extends PhpTemplate
{
    const VIS_PUBLIC = 'public';
    const VIS_PROTECTED = 'protected';
    const VIS_PRIVATE = 'private';

    private $name;
    private $visibility;

    /** @var PhpNamedVar[] */
    private $arguments = array();

    /** @var PhpAnyType */
    private $result;

    private $body;
    private $phpDoc;


    private $isStatic;

    /**
     * PhpFunction constructor.
     * @param $name
     * @param $visibility
     * @param $isStatic
     */
    public function __construct($name, $visibility = null, $isStatic = false)
    {
        $this->name = $name;
        $this->visibility = $visibility;
        $this->isStatic = $isStatic;
    }

    protected function toString()
    {
        return <<<PHP
{$this->headToString()}
{
{$this->tabLines($this->body)}}
PHP;
    }

    public function headToString()
    {
        return <<<PHP
{$this->renderVisibility()}{$this->renderIsStatic()}function {$this->name}({$this->renderArguments()})
PHP;


    }

    private function renderArguments()
    {
        $result = '';
        foreach ($this->arguments as $argument) {
            $result .= "{$argument->renderArgumentType()}\${$argument->getName()}, ";
        }
        if ($result) {
            $result = substr($result, 0, -2);
        }
        return $result;
    }

    private function renderVisibility()
    {
        if ($this->visibility) {
            return $this->visibility . ' ';
        } else {
            return '';
        }
    }

    private function renderIsStatic()
    {
        if ($this->isStatic) {
            return 'static ';
        } else {
            return '';
        }
    }

    public function addArgument(PhpNamedVar $argument)
    {
        $this->arguments[] = $argument;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param mixed $body
     * @return PhpFunction
     */
    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }


}