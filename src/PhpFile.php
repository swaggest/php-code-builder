<?php

namespace Swaggest\PhpCodeBuilder;

class PhpFile extends PhpTemplate
{
    private $namespace;
    private $namespaces;
    private $code;

    public function __construct()
    {
        $this->namespaces = new PhpNamespaces();
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

}