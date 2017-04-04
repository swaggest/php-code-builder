<?php

namespace Swaggest\PhpCodeBuilder;

use Swaggest\CodeBuilder\ClosureString;

class PhpCode extends PhpTemplate
{
    public $snippets;

    public function __construct($body = null)
    {
        if ($body != null) {
            $this->addSnippet($body);
        }
    }

    public function addSnippet($code, $prepend = false)
    {
        if ($prepend) {
            array_unshift($this->snippets, $code);
        } else {
            $this->snippets[] = $code;
        }
        return $this;
    }

    public function toString()
    {
        $result = '';
        if ($this->snippets === null) {
            return '';
        }
        foreach ($this->snippets as $code) {
            if ($code instanceof ClosureString) {
                $result .= $code->toString();
            } else {
                $result .= $code;
            }
        }
        return $result;
    }
}