<?php

namespace Swaggest\PhpCodeBuilder\App;

use Swaggest\CodeBuilder\App\App;
use Swaggest\PhpCodeBuilder\JsonSchema\PhpBuilder;
use Swaggest\PhpCodeBuilder\PhpClassTraitInterface;
use Swaggest\PhpCodeBuilder\PhpFile;

class PhpApp extends App
{
    /** @var PhpClassTraitInterface[] */
    private $classes = [];
    /** @var PhpFile[][] */
    private $phpFiles = [];
    /** @var PhpBuilder */
    private $builder;

    private $psr4Namespaces = [];

    public function setNamespaceRoot($namespace, $relativePath = './src/')
    {
        $relativePath = rtrim($relativePath, '/') . '/';

        $this->psr4Namespaces[$namespace] = $relativePath;
        return $this;
    }

    /**
     * @param PhpBuilder $builder
     * @return PhpApp
     */
    public function setBuilder($builder)
    {
        $this->builder = $builder;
        return $this;
    }
    
    public function addClass(PhpClassTraitInterface $class)
    {
        //$this->classes[] = $class;

        if (!$class->getName()) {
            throw new \Exception('Can not store unnamed class');
        }
        $ns = $class->getNamespace();
        $filepath = $class->getName() . '.php';
        if ($ns) {
            $namespaceFound = false;
            foreach ($this->psr4Namespaces as $namespace => $relativePath) {
                $nns = substr($ns, 0, strlen($namespace));
                if ($namespace === $nns) {
                    $innerPath = str_replace('\\', '/', substr($ns, strlen($namespace)));
                    $innerPath = trim($innerPath, '/') . '/';
                    $filepath = $relativePath . $innerPath . $class->getName() . '.php';
                    $namespaceFound = true;
                    break;
                }
            }
            if (!$namespaceFound) {
                throw new \Exception('Namespace not found: ' . $ns);
            }
        }
        $file = new PhpFile();
        if ($ns) {
            $file->setNamespace($ns);
            $file->getNamespaces()->add($class->getFullyQualifiedName());
        }
        $file->getCode()->addSnippet($class);
        $this->files[$filepath] = $file;

        return $this;
    }

    public function addFile($contents, $relativePath)
    {
        $this->files[$relativePath] = $contents;
    }

    public function addPhpFile(PhpFile $file, $relativePath = './')
    {
        $this->phpFiles[$relativePath][] = $file;
        return $this;
    }
}