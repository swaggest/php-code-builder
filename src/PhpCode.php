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

    protected function toString()
    {
        $result = '';
        if ($this->snippets === null) {
            return '';
        }
        foreach ($this->snippets as $code) {
            if ($code instanceof ClosureString) {
                $result .= $code->render();
            } else {
                $result .= $code;
            }
        }
        return $result;
    }

    public static function toCamelCase($string, $lowerFirst = false)
    {
        $result = implode('', array_map('ucfirst', explode('_', $string)));
        if (!$result) {
            return '';
        }
        if ($lowerFirst) {
            $result[0] = strtolower($result[0]);
        }
        return $result;
    }


    public static function makePhpName($rawName, $lowerFirst = true)
    {
        $phpName = preg_replace("/([^a-zA-Z0-9_]+)/", "_", $rawName);
        $phpName = self::toCamelCase($phpName, $lowerFirst);
        if (!$phpName) {
            $phpName = 'property' . substr(md5($rawName), 0, 6);
        } elseif (is_numeric($phpName[0])) {
            $phpName = 'property' . $phpName;
        }
        return $phpName;
    }

    public static function makePhpConstantName($rawName)
    {
        $phpName = preg_replace("/([^a-zA-Z0-9_]+)/", "_", $rawName);

        if (!$phpName) {
            $phpName = 'const_' . substr(md5($rawName), 0, 6);
        } elseif (is_numeric($phpName[0])) {
            $phpName = 'const_' . $phpName;
        }
        return strtoupper($phpName);
    }

}