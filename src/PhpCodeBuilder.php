<?php
namespace Swaggest\PhpCodeBuilder;

use Platform\ApiGenerator\Exception;
use Platform\Schema\Base;
use Platform\Schema\Primitives\BooleanStructure;
use Platform\Schema\Primitives\DateStructure;
use Platform\Schema\Primitives\DateTimeStructure;
use Platform\Schema\Primitives\IntegerStructure;
use Platform\Schema\Primitives\ListStructure;
use Platform\Schema\Primitives\NumberStructure;
use Platform\Schema\Primitives\RawStructure;
use Platform\Schema\Primitives\StringStructure;
use Platform\Schema\Primitives\TimestampStructure;
use Platform\Schema\Structure;
use Swaggest\CodeBuilder\CodeBuilder;
use Yaoi\String\StringValue;

class PhpCodeBuilder extends CodeBuilder
{
    public $phpDefinitions = array(); // TODO hide
    public $namespace;
    public $srcPath = './src';

    public $phpDocHead = <<<PHPDOC
 * ATTENTION! This class was generated automatically, any manual modifications may be lost.
PHPDOC;

    public $phpDocVersion;

    public function setBuilderVersion($builderVersion)
    {
        $this->phpDocVersion = <<<PHPDOC

 * $builderVersion.
PHPDOC;
    }

    public function addClassSource($fullyQualifiedClassName, $code, $phpDoc, $extends, $implements = array())
    {
        //var_dump("ADDING CLASS " . $fullyQualifiedClassName);

        $dividerPosition = strrpos($fullyQualifiedClassName, '\\');
        $className = substr($fullyQualifiedClassName, $dividerPosition + 1);
        $namespace = substr($fullyQualifiedClassName, 0, $dividerPosition);
        $namespace = str_replace('\\\\', '\\', $namespace);

        $namespace = ltrim($namespace, '\\');
        Base::$usedClassNames[$fullyQualifiedClassName] = null;

        $classHeader = $className;
        if ($extends) {
            Base::$usedClassNames[$extends] = null;
            $classHeader .= ' extends ' . $extends;
        }
        if ($implements) {
            $classHeader .= ' implements ' . implode(', ', $implements);
        }

        $phpDoc = rtrim($phpDoc);
        if ($phpDoc) {
            $phpDoc = <<<PHPDOC
/**
$phpDoc
 */

PHPDOC;
        }

        $definitionCode = <<<PHP
namespace $namespace;

{$phpDoc}class $classHeader
{
$code
}
PHP;
        $definitionCode = $this->processNamespaces($definitionCode, $fullyQualifiedClassName, $namespace);

        $definitionCode = <<<PHP

/**
 * @file
{$this->phpDocHead}{$this->phpDocVersion}
 */

$definitionCode
PHP;


        $this->phpDefinitions[$fullyQualifiedClassName] = $definitionCode;
        //var_dump("ADDED CLASS " . $fullyQualifiedClassName);

        return $this;

    }

    private function processNamespaces($code, $definitionClassName, $namespace)
    {
        krsort(Base::$usedClassNames);
        $use = array();
        foreach (Base::$usedClassNames as $className => $tmp) {
            if (strpos($code, $className)) {
                $position = strrpos($className, '\\');
                $shortName = substr($className, $position + 1);
                $storeName = $shortName;
                $index = 0;

                $relativeClassName = $className;

                while (isset($use[$storeName])) {
                    $storeName = $shortName . ++$index;
                }

                if ($relativeClassName) {
                    if ($shortName !== $storeName) {
                        $use[$storeName] = 'use ' . $relativeClassName . ' as ' . $storeName . ';';
                    } else {
                        $localName = StringValue::create($relativeClassName)->afterStarts('\\' . $namespace . '\\');
                        if ($shortName !== $localName) {
                            $use[$storeName] = 'use ' . $relativeClassName . ';';
                        }
                    }
                }

                $code = str_replace($className, $storeName, $code);
            }
        }

        if ($use) {
            $code = explode("\n", $code, 2);
            $code = implode("\n", array($code[0], '', implode("\n", $use), $code[1]));
        }

        return $code;
    }

    public function storeToDisk($rootPath)
    {
        if (!$rootPath) {
            throw new Exception('No src path');
        }


        $this->originalFiles = $this->recursiveFileList($rootPath,
            array('php' => 1, 'json' => 1, 'md' => 1, 'MD' => 1),
            array('vendor', 'tests', '.git', 'composer.lock', 'swagger.json', 'swagger-rpc.json', '.idea')
        );

        $slashed = $this->namespace . '\\';
        $namespaceLen = strlen($slashed);
        foreach ($this->phpDefinitions as $className => $code) {
            if (substr($className, 0, $namespaceLen) !== $slashed) {
                throw new \Platform\Schema\Exception('Class does not belong to namespace: ' . $className);
            }
            $stripped = substr($className, $namespaceLen);
            $separatorPos = strrpos($stripped, '\\');
            if (false !== $separatorPos) {
                $filename = substr($stripped, $separatorPos + 1);
                $dir = str_replace('\\', '/', substr($stripped, 0, $separatorPos));
            } else {
                $filename = $stripped;
                $dir = '.';
            }

            $filename = $this->srcPath . '/' . $dir . '/' . $filename . '.php';
            $this->addFile($filename, '<?php' . "\n" . $code);
        }

        parent::storeToDisk($rootPath);
    }


    public function toCamelCase($string, $lowerFirst = false)
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


    public function makePhpName($rawName, $lowerFirst = true)
    {
        $phpName = preg_replace("/([^a-zA-Z0-9_]+)/", "_", $rawName);
        $phpName = $this->toCamelCase($phpName, $lowerFirst);
        if (!$phpName) {
            $phpName = 'property' . substr(md5($rawName), 0, 6);
        } elseif (is_numeric($phpName[0])) {
            $phpName = 'property' . $phpName;
        }
        return $phpName;
    }

    public function getPHPDoc(Structure $structure)
    {
        switch (true) {
            case $structure instanceof DateTimeStructure:
            case $structure instanceof DateStructure:
            case $structure instanceof TimestampStructure:
                return '\\DateTime';
            case $structure instanceof IntegerStructure:
                return 'int';
            case $structure instanceof StringStructure:
                return 'string';
            case $structure instanceof BooleanStructure:
                return 'bool';
            case $structure instanceof NumberStructure:
                return 'float';
            case $structure instanceof ListStructure:
                return 'array';
            case $structure instanceof RawStructure:
                return 'mixed';
            default:
                return $structure::className();
        }
    }

    public static function processMethodPhpdoc($phpDoc)
    {
        if (strpos($phpDoc, '     * @return') !== false
            && strpos($phpDoc, '     * @param') !== false
        ) {
            $phpDoc = str_replace('     * @return', "     *\n     * @return", $phpDoc);
        }

        return $phpDoc;

    }

    public function getPHPType(Structure $structure)
    {
        return '';
    }
}