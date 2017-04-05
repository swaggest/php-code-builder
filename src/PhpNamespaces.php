<?php

namespace Swaggest\PhpCodeBuilder;


class PhpNamespaces extends PhpTemplate
{
    private $namespaces = array();
    private $shortNames = array();

    public function add($fullyQualifiedName, $as = null)
    {
        if (null === $as) {
            $i = '';
            $short = $this->makeShortName($fullyQualifiedName);
            while (isset($this->shortNames[$short . $i])) {
                $i++;
            }
            $as = $short . $i;
        }
        $this->namespaces[$fullyQualifiedName] = $as;
        $this->shortNames[$as] = $fullyQualifiedName;
        return $this;
    }

    private function makeShortName($fqn)
    {
        $path = explode('\\', $fqn);
        return array_pop($path);
    }

    public function getReference($fullyQualifiedName)
    {
        if (!isset($this->namespaces[$fullyQualifiedName])) {
            $this->add($fullyQualifiedName);
        }
        return $this->namespaces[$fullyQualifiedName];
    }

    protected function toString()
    {
        $result = '';
        foreach ($this->namespaces as $namespace => $as) {
            $short = $this->makeShortName($namespace);
            if ($short === $as) {
                $as = '';
            }
            $renderAs = $as ? ' as ' . $as : '';
            $result .= <<<PHP
use {$namespace}{$renderAs};

PHP;
        }
        return $result;
    }
}