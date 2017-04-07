<?php

namespace Swaggest\PhpCodeBuilder\Tests\PHPUnit\JsonSchema;


use Swaggest\JsonSchema\RemoteRef\Preloaded;
use Swaggest\JsonSchema\SchemaLoader;
use Swaggest\PhpCodeBuilder\JsonSchema\PhpBuilder;
use Swaggest\PhpCodeBuilder\PhpCode;
use Swaggest\PhpCodeBuilder\PhpFile;

class SwaggerSchemaGenerateTest extends \PHPUnit_Framework_TestCase
{
    public function testJsonSchemaGenerate()
    {
        $loader = SchemaLoader::create();
        $loader->setRemoteRefProvider(new Preloaded());

        $schemaData = json_decode(file_get_contents(__DIR__ . '/../../../../../json-schema/spec/swagger-schema.json'));


        $schema = $loader->readSchema($schemaData);

        $builder = new PhpBuilder();
        $builder->getType($schema);

        $phpFile = new PhpFile();
        $phpCode = $phpFile->getCode();

        $namespace = 'Swaggest\\JsonSchema\\SwaggerSchema';
        $phpFile->setNamespace($namespace);

        $classes = array();
        foreach ($builder->getGeneratedClasses() as $class) {
            if ($class->path === '#') {
                $className = 'SwaggerSchema';
            } else {
                $path = str_replace('#/definitions/', '', $class->path);
                $className = PhpCode::makePhpName($path, false);
            }
            if (!isset($classes[$className])) {
                $classes[$className] = 1;
                $class->class->setName($className);
                $class->class->setNamespace($namespace);
                $phpCode->addSnippet($class->class);
                $phpCode->addSnippet("\n\n");
            }
        }

        $dir = __DIR__ . '/../../../../../json-schema/src/SwaggerSchema';
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }
        file_put_contents($dir . '/SwaggerSchema.php', (string)$phpFile);

        echo $phpFile;
    }

}