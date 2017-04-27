<?php

namespace Swaggest\PhpCodeBuilder\Tests\PHPUnit\JsonSchema;


use Swaggest\JsonSchema\JsonSchema;
use Swaggest\JsonSchema\ProcessingOptions;
use Swaggest\JsonSchema\RemoteRef\Preloaded;
use Swaggest\PhpCodeBuilder\JsonSchema\PhpBuilder;
use Swaggest\PhpCodeBuilder\PhpCode;
use Swaggest\PhpCodeBuilder\PhpFile;

class SwaggerSchemaGenerateTest extends \PHPUnit_Framework_TestCase
{
    public function testJsonSchemaGenerate()
    {
        $schemaData = json_decode(file_get_contents(__DIR__ . '/../../../../../json-schema/spec/swagger-schema.json'));


        $refProvider = new Preloaded();
        $refProvider->setSchemaData('http://swagger.io/v2/schema.json', $schemaData);

        $options = new ProcessingOptions();
        $options->setRemoteRefProvider($refProvider);


        $swaggerSchema = JsonSchema::importToSchema($schemaData, $options);

        $builder = new PhpBuilder();
        $builder->getType($swaggerSchema); // #->paths->^/->get->parameters->items

        $classes = array();
        $files = array();
        foreach ($builder->getGeneratedClasses() as $class) {
            $phpFile = new PhpFile();
            $phpCode = $phpFile->getCode();

            $namespace = 'Swaggest\\JsonSchema\\SwaggerSchema';
            $phpFile->setNamespace($namespace);

            if ($class->path === '#') {
                $className = 'SwaggerSchema';
            } else {
                $schema = $class->schema;
                $path = $class->path;
                if ($schema->getFromRef()) {
                    $path = $schema->getFromRef();
                }
                //echo $path, "\n";
                $path = str_replace('#/definitions/', '', $path);
                $className = PhpCode::makePhpName($path, false);
            }
            if (!isset($classes[$className])) {
                $classes[$className] = 1;
                $class->class->setName($className);
                $class->class->setNamespace($namespace);
                $phpCode->addSnippet($class->class);
                $phpCode->addSnippet("\n\n");

                $files[$className] = $phpFile;
            }
        }

        /*
        $ts = $swaggerSchema->definitions['header']->properties['maximum'];
        $t = $builder->getType($ts);
        var_dump($t);
        echo $t->renderPhpDocType();
        die();
        */


        $dir = __DIR__ . '/../../../../../json-schema/src/SwaggerSchema';
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }
        foreach ($files as $className => $phpFile) {
            file_put_contents($dir . '/' . $className . '.php', (string)$phpFile);
        }

        //echo $phpFile;
    }

}