<?php

namespace Swaggest\PhpCodeBuilder\Tests\PHPUnit\JsonSchema;


use Swaggest\JsonSchema\RemoteRef\Preloaded;
use Swaggest\JsonSchema\Schema;
use Swaggest\PhpCodeBuilder\JsonSchema\PhpBuilder;
use Swaggest\PhpCodeBuilder\PhpCode;
use Swaggest\PhpCodeBuilder\PhpFile;

class JsonSchemaGenerateTest extends \PHPUnit_Framework_TestCase
{
    public function testJsonSchemaGenerate()
    {
        //$loader = SchemaLoader::create();
        //$loader->setRemoteRefProvider(new Preloaded());

        $schemaData = json_decode(file_get_contents(__DIR__ . '/../../../../../json-schema/spec/json-schema.json'));
        $schema = Schema::schema()->in($schemaData);

        //$schema = $loader->readSchema($schemaData);

        $builder = new PhpBuilder();
        $builder->getType($schema);

        $phpFile = new PhpFile();
        $namespace = 'Swaggest\\JsonSchema';
        $phpFile->setNamespace($namespace);

        $phpCode = $phpFile->getCode();
        $classesDone = array();
        foreach ($builder->getGeneratedClasses() as $class) {

            if ($class->path === '#') {
                $class->class->setName('JsonSchema');
            } else {
                $path = str_replace('#/definitions/', '', $class->path);
                $class->class->setName(PhpCode::makePhpName($path, false));
            }

            $class->class->setNamespace($namespace);

            if (!isset($classesDone[$class->class->getName()])) {
                $className = $class->class->getName();
                $phpCode->addSnippet($class->class);
                $phpCode->addSnippet("\n\n");

                $classesDone[$className] = 1;
            }
        }

        $dir = __DIR__ . '/../../../../../json-schema/src';
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }
        file_put_contents($dir . '/JsonSchema.php', (string)$phpFile);

        echo $phpFile;


    }

}