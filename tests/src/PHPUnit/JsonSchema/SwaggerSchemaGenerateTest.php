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
        foreach ($builder->getGeneratedClasses() as $class) {
            if ($class->path === '#') {
                $class->class->setName('SwaggerSchema');
            } else {
                $class->class->setName(PhpCode::makePhpName($class->path, false));
            }
            $phpCode->addSnippet($class->class);
            $phpCode->addSnippet("\n\n");
        }

        echo $phpFile;
    }

}