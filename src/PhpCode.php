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
        $index = array();
        foreach ($ret as &$match) {
            $index[$match] = '_' . ($match == strtoupper($match) ? strtolower($match) : lcfirst($match));
        }
        krsort($index);
        $result = strtr($input, $index);
        if ($input[0] !== '_' && $result[0] === '_') {
            $result = substr($result, 1);
        }
        return preg_replace('/_+/', '_', $result);
    }


    public static function makePhpName($rawName, $lowerFirst = true)
    {
        $phpName = preg_replace("/([^a-zA-Z0-9_]+)/", "_", $rawName);
        $phpName = self::toCamelCase($phpName, $lowerFirst);
        if (!$phpName) {
            $phpName = 'Property' . substr(md5($rawName), 0, 6);
        } elseif (is_numeric($phpName[0])) {
            $phpName = 'Property' . $phpName;
        }
        if ($lowerFirst) {
            $phpName[0] = strtolower($phpName[0]);
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
        if (is_string($phpName)) {
            $phpName = trim($phpName, '_');
        }

        if ($phpName) {
            $phpName = self::fromCamelCase($phpName);

            if (in_array(strtolower($phpName), self::$keywords)) {
                $phpName = '_' . $phpName;
            }

            if (is_numeric($phpName[0])) {
                $phpName = 'const_' . $phpName;
            }
        } else {
            $phpName = 'const_' . substr(md5($rawName), 0, 6);
        }

        return strtoupper($phpName);
    }


    public static function varExport($value)
    {
        /** @var string $result */
        $result = '';

        if (is_array($value)) {
            if (count($value) === 0) {
                return '[]';
            }

            $i = 0;
            $sequential = true;
            foreach ($value as $k => $v) {
                if ($k !== $i) {
                    $sequential = false;
                    break;
                }
                ++$i;
            }
            $t = new self();
            $result .= "[\n";
            if ($sequential) {
                foreach ($value as $item) {
                    $result .= $t->padLines('    ', self::varExport($item), false) . ",\n";
                }
            } else {
                foreach ($value as $key => $item) {
                    $result .= $t->padLines('    ', self::varExport($key) . ' => ' . self::varExport($item), false) . ",\n";
                }
            }
            $result .= "]";
            return $result;
        }

        if ($value instanceof \stdClass) {
            return '(object)' . self::varExport((array)$value);
        }


        $result = var_export($value, true);
        $result = str_replace("stdClass::__set_state", "(object)", $result);
        $result = str_replace("array (\n", "array(\n", $result);
        $result = str_replace('  ', '    ', $result);
        $result = str_replace("array(\n)", "array()", $result);
        return $result;
    }

}
