<?php

namespace Swaggest\PhpCodeBuilder;


use Swaggest\PhpCodeBuilder\Traits\Description;
use Swaggest\PhpCodeBuilder\Traits\StaticFlag;
use Swaggest\PhpCodeBuilder\Traits\Visibility;

class PhpFunction extends PhpTemplate
{
    use Visibility;
    use StaticFlag;
    use Description;

    private $name;

    /** @var PhpNamedVar[] */
    private $arguments = array();

    /** @var PhpAnyType */
    private $result;

    /** @var PhpAnyType[] */
    private $throws;

    private $body;
    public $skipCodeCoverage = false;


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
        $tail = '';
        if ($this->skipCodeCoverage) {
            $tail = (new PhpDocTag(PhpDoc::TAG_CODE_COVERAGE_IGNORE_END))->render() . "\n";
        }

        return <<<PHP
{$this->headToString()}
{
{$this->indentLines(trim($this->body) . "\n")}}
$tail

PHP;
    }

    public function headToString()
    {
        return <<<PHP
{$this->renderPhpDoc()}{$this->renderVisibility()}{$this->renderIsStatic()}function {$this->name}({$this->renderArguments()})
PHP;


    }

    private function renderPhpDoc()
    {
        $result = new PhpDoc();
        if ($this->description) {
            $result->add(null, $this->description);
        }
        foreach ($this->arguments as $argument) {
            $result->add(PhpDoc::TAG_PARAM, $argument->renderPhpDocValue(true));
        }
        if ($this->result && $returnType = $this->result->renderPhpDocType()) {
            $result->add(PhpDoc::TAG_RETURN, $returnType);
        }
        if ($this->throws) {
            foreach ($this->throws as $throws) {
                if ($throwsType = $throws->renderPhpDocType()) {
                    $result->add(PhpDoc::TAG_THROWS, $throwsType);
                }
            }
        }
        if ($this->skipCodeCoverage) {
            $result->add(PhpDoc::TAG_CODE_COVERAGE_IGNORE_START);
        }
        return (string)$result;
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

    /**
     * @param PhpAnyType $result
     * @return PhpFunction
     */
    public function setResult(PhpAnyType $result = null)
    {
        $this->result = $result;
        return $this;
    }

    /**
     * @param PhpAnyType $throws
     * @return PhpFunction
     */
    public function setThrows($throws)
    {
        $this->throws = array($throws);
        return $this;
    }

    /**
     * @param PhpAnyType $throws
     * @return PhpFunction
     */
    public function addThrows($throws)
    {
        $this->throws []= $throws;
        return $this;
    }



}