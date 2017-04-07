<?php

namespace Swaggest\PhpCodeBuilder;

use PhpLang\ScopeExit;

class PhpFile extends PhpTemplate
{
    /** @var string */
    private $namespace;
    /** @var PhpNamespaces */
    private $namespaces;
    /** @var PhpCode */
    private $code;

    public function __construct($namespace = null)
    {
        $this->namespace = $namespace;
        $this->namespaces = new PhpNamespaces();
        $this->code = new PhpCode();
    }

    /**
     * @return PhpNamespaces
     */
    public function getNamespaces()
    {
        return $this->namespaces;
    }

    protected function toString()
    {
        $prev = self::setCurrentPhpFile($this);
        /** @noinspection PhpUnusedLocalVariableInspection */
        $_ = new ScopeExit(function () use ($prev) {
            self::setCurrentPhpFile($prev);
        });

        $this->namespaces->setFileNamespace($this->namespace);
        $code = $this->code->toString();
        $result = <<<PHP
<?php

{$this->renderNamespace()}{$this->namespaces}

{$code}
PHP;
        return $result;

    }

    private function renderNamespace()
    {
        return $this->namespace
            ? "namespace " . $this->namespace . ";\n\n"
            : '';

    }

    /** @var PhpFile */
    private static $currentPhpFile;

    /**
     * @return PhpFile
     */
    public static function getCurrentPhpFile()
    {
        return self::$currentPhpFile;
    }

    /**
     * @param $currentPhpFile
     * @return PhpFile previous php file
     */
    public static function setCurrentPhpFile($currentPhpFile)
    {
        $previous = self::$currentPhpFile;
        self::$currentPhpFile = $currentPhpFile;
        return $previous;
    }

    /**
     * @return string
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * @param string $namespace
     * @return PhpFile
     */
    public function setNamespace($namespace)
    {
        $this->namespace = $namespace;
        return $this;
    }

    /**
     * @return PhpCode
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param PhpCode $code
     * @return PhpFile
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }
}