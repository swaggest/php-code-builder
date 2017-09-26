<?php

namespace Swaggest\PhpCodeBuilder\App;

use Swaggest\CodeBuilder\App\App;
use Swaggest\PhpCodeBuilder\PhpClassTraitInterface;
use Swaggest\PhpCodeBuilder\PhpFile;

class PhpApp extends App
{
    /** @var PhpClassTraitInterface[] */
    private $classes = [];
    /** @var PhpFile[][] */
    private $phpFiles = [];

    private $psr4Namespaces = [];

    public function setNamespaceRoot($namespace, $relativePath = './src/')
    {
        $relativePath = rtrim($relativePath, '/') . '/';

        $this->psr4Namespaces[$namespace] = $relativePath;
        return $this;
    }

    public function addClass(PhpClassTraitInterface $class)
    {
        $this->classes[] = $class;
        return $this;
    }

    public function addFile(PhpFile $file, $relativePath = './')
    {
        $this->phpFiles[$relativePath][] = $file;
        return $this;
    }

    public function store($path) {
        $path = rtrim($path, '/') . '/';

        foreach ($this->classes as $class) {
            if (!$class->getName()) {
                throw new \Exception('Can not store unnamed class');
            }
            $ns = $class->getNamespace();
            $filepath = $path . $class->getName() . '.php';
            if ($ns) {
                $namespaceFound = false;
                foreach ($this->psr4Namespaces as $namespace => $relativePath) {
                    $nns = substr($ns, 0, strlen($namespace));
                    if ($namespace === $nns) {
                        $innerPath = str_replace('\\', '/', substr($ns, strlen($namespace)));
                        $innerPath = trim($innerPath, '/') . '/';
                        $filepath = $path . $relativePath . $innerPath . $class->getName() . '.php';
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
            }
            $file->getCode()->addSnippet($class);
            $this->putContents($filepath, $file->render());
        }

    }

}