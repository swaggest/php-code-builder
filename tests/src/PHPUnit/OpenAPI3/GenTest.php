<?php

namespace Swaggest\PhpCodeBuilder\Tests\PHPUnit\OpenAPI3;

use Swaggest\JsonSchema\Context;
use Swaggest\JsonSchema\InvalidValue;
use Swaggest\JsonSchema\RemoteRef\Preloaded;
use Swaggest\JsonSchema\Schema;
use Swaggest\PhpCodeBuilder\App\PhpApp;
use Swaggest\PhpCodeBuilder\JsonSchema\ClassHookCallback;
use Swaggest\PhpCodeBuilder\JsonSchema\PhpBuilder;
use Swaggest\PhpCodeBuilder\JsonSchema\SchemaExporterInterface;
use Swaggest\PhpCodeBuilder\PhpClass;
use Swaggest\PhpCodeBuilder\PhpCode;
use Swaggest\PhpCodeBuilder\Tests\Tmp\OpenAPI3\DefinitionsSchema;
use Swaggest\PhpCodeBuilder\Tests\Tmp\OpenAPI3\OpenAPI3Schema;

class GenTest extends \PHPUnit_Framework_TestCase
{
    protected $nsItem = 'OpenAPI3';

    public function testGenerateOpenAPI3()
    {
        $schemaData = json_decode(file_get_contents(__DIR__ . '/../../../resources/openapi3-schema.json'));

        $refProvider = new Preloaded();
//        $refProvider->setSchemaData('http://swagger.io/v2/schema.json', $schemaData);

        $options = new Context();
        $options->setRemoteRefProvider($refProvider);

        $swaggerSchema = Schema::import($schemaData, $options);

        $appPath = realpath(__DIR__ . '/../../Tmp') . '/' . $this->nsItem;
        $appNs = 'Swaggest\PhpCodeBuilder\Tests\Tmp\\' . $this->nsItem;

        $app = new PhpApp();
        $app->setNamespaceRoot($appNs, '.');

        $builder = new PhpBuilder();
        $builder->buildSetters = true;
        $builder->makeEnumConstants = true;
        $builder->minimizeRefs = true;
        $builder->namesFromDescriptions = true;

        $builder->classCreatedHook = new ClassHookCallback(function (PhpClass $class, $path, $schema) use ($app, $appNs) {
            $desc = '';
            if ($schema->title) {
                $desc = $schema->title;
            }
            if ($schema->description) {
                $desc .= "\n" . $schema->description;
            }
            if ($fromRefs = $schema->getFromRefs()) {
                $desc .= "\nBuilt from " . implode("\n" . ' <- ', $fromRefs);
            }

            $class->setDescription(trim($desc));

            $class->setNamespace($appNs);
            if ('#' === $path) {
                $class->setName('OpenAPI3Schema');
            } elseif ('#/definitions/' === substr($path, 0, strlen('#/definitions/'))) {
                $className = PhpCode::makePhpClassName(substr($path, strlen('#/definitions/')));
                if ($className === 'Schema') {
                    $className = 'DefinitionsSchema';
                }
                $class->setName($className);
            }
            $app->addClass($class);
        });

        $builder->classPreparedHook = new SchemaExporterInterface();

        $builder->getType($swaggerSchema);
        $app->clearOldFiles($appPath);
        $app->store($appPath);

        exec('git diff ' . $appPath, $out);
        $out = implode("\n", $out);
        $this->assertSame('', $out, "Generated files changed");
    }


    public function testReadOpenAPI3Schema()
    {
        // Load schema
        $json = json_decode(file_get_contents(__DIR__ . '/../../../resources/petstore-openapi3.json'));

        // Import and validate
        try {
            $options = new Context();
            $options->dereference = true;
            $schema = OpenAPI3Schema::import($json, $options);
        } catch (InvalidValue $e) {
            echo $e->getMessage();
            $schemaPtr = $e->getSchemaPointer();
            var_dump($schemaPtr);
            print_r($e->inspect());
            return;

        }

        // Access data through PHP classes
        $this->assertSame('Swagger Petstore', $schema->info->title);
        $ops = $schema->paths['/pets']->getGetPutPostDeleteOptionsHeadPatchTraceValues();
        $this->assertSame('findPets', $ops['get']->operationId);

        $responseSchema = $ops['get']->responses[200]->content['application/json']->schema;
        $this->assertSame(Schema::_ARRAY, $responseSchema->type);

        $postBody = $ops['post']->requestBody;
        $this->assertSame('Pet to add to the store', $postBody->description);

        $bodySchema = $postBody->content['application/json']->schema;
        $this->assertTrue($bodySchema instanceof DefinitionsSchema);
        $this->assertSame(Schema::OBJECT, $bodySchema->type);
    }

}