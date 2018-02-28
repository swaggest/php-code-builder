<?php

namespace Swaggest\PhpCodeBuilder;


use Swaggest\PhpCodeBuilder\JsonSchema\Palette;

class PhpNamespaces extends PhpTemplate
{
    private $fileNamespace = '';
    private $namespaces = array();
    private $shortNames = array();

    public function add($fullyQualifiedName, $as = null)
    {
        if ($fullyQualifiedName[0] !== '\\') {
            $fullyQualifiedName = '\\' . $fullyQualifiedName;
        }
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
        if ($fullyQualifiedName[0] !== '\\') {
            $fullyQualifiedName = '\\' . $fullyQualifiedName;
        }
        if (!isset($this->namespaces[$fullyQualifiedName])) {
            if ($fullyQualifiedName === Palette::schemaClass()->getFullyQualifiedName()) {
                $this->add($fullyQualifiedName, 'JsonBasicSchema');
            } else {
                $this->add($fullyQualifiedName);
            }
        }
        return $this->namespaces[$fullyQualifiedName];
    }

    protected function toString()
    {
        $result = '';
        ksort($this->namespaces);
        foreach ($this->namespaces as $namespace => $as) {
            $namespace = trim($namespace, '\\');
            $short = $this->makeShortName($namespace);
            if ($short === $as) {
                $as = '';
            }
            $namespacePieces = explode('\\', $namespace);
            array_pop($namespacePieces);
            $packageNamespace = implode('\\', $namespacePieces);
            if ($this->fileNamespace === '\\' . $packageNamespace) {
                continue;
            }
            $renderAs = $as ? ' as ' . $as : '';
            if (!$renderAs && $namespace === $this->fileNamespace . '\\' . $short) {
                continue;
            }
            $result .= <<<PHP
use {$namespace}{$renderAs};

PHP;
        }
        return $result;
    }

    /**
     * @param string $fileNamespace
     * @return PhpNamespaces
     */
    public function setFileNamespace($fileNamespace)
    {
        $this->fileNamespace = $fileNamespace;
        return $this;
    }
}