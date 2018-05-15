<?php

namespace Swaggest\PhpCodeBuilder;

use Swaggest\CodeBuilder\AbstractTemplate;

class PhpCode extends PhpTemplate
{
    public $snippets;

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
            if ($code instanceof AbstractTemplate) {
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

    public static function fromCamelCase($input)
    {
        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
        $ret = $matches[0];
        foreach ($ret as &$match) {
            $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
        }
        return implode('_', $ret);
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

    private static $keywords = array('__halt_compiler', 'abstract', 'and', 'array', 'as', 'break', 'callable', 'case', 'catch', 'class', 'clone', 'const', 'continue', 'declare', 'default', 'die', 'do', 'echo', 'else', 'elseif', 'empty', 'enddeclare', 'endfor', 'endforeach', 'endif', 'endswitch', 'endwhile', 'eval', 'exit', 'extends', 'final', 'for', 'foreach', 'function', 'global', 'goto', 'if', 'implements', 'include', 'include_once', 'instanceof', 'insteadof', 'interface', 'isset', 'list', 'namespace', 'new', 'or', 'print', 'private', 'protected', 'public', 'require', 'require_once', 'return', 'static', 'switch', 'throw', 'trait', 'try', 'unset', 'use', 'var', 'while', 'xor');

    public static function makePhpClassName($rawName)
    {
        $result = self::makePhpName($rawName, false);
        if (in_array(strtolower($result), self::$keywords)) {
            $result .= 'Class';
        }
        return $result;
    }

    public static function makePhpNamespaceName(array $nsItems)
    {
        $result = array();
        foreach ($nsItems as $nsItem) {
            $nsItem = self::makePhpName($nsItem, false);
            if (!$nsItem) {
                continue;
            }
            if (in_array(strtolower($nsItem), self::$keywords)) {
                $nsItem .= 'Ns';
            }
            $result[] = $nsItem;
        }

        return '\\' . implode('\\', $result);
    }

    public static function makePhpConstantName($rawName)
    {
        $phpName = preg_replace("/([^a-zA-Z0-9_]+)/", "_", $rawName);

        $phpName = self::fromCamelCase($phpName);

        if (in_array(strtolower($phpName), self::$keywords)) {
            $phpName = '_' . $phpName;
        }

        if (!$phpName) {
            $phpName = 'const_' . substr(md5($rawName), 0, 6);
        } elseif (is_numeric($phpName[0])) {
            $phpName = 'const_' . $phpName;
        }
        return strtoupper($phpName);
    }

}