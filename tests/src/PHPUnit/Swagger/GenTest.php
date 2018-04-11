<?php

namespace Swaggest\PhpCodeBuilder\Tests\PHPUnit\Swagger;

use Swaggest\JsonSchema\Context;
use Swaggest\JsonSchema\RemoteRef\Preloaded;
use Swaggest\JsonSchema\Schema;
use Swaggest\PhpCodeBuilder\App\PhpApp;
use Swaggest\PhpCodeBuilder\JsonSchema\ClassCreatedHookCallback;
use Swaggest\PhpCodeBuilder\JsonSchema\PhpBuilder;
use Swaggest\PhpCodeBuilder\PhpClass;
use Swaggest\PhpCodeBuilder\PhpCode;

class GenTest extends \PHPUnit_Framework_TestCase
{
    public function testGenerateSwagger()
    {
        $schemaData = json_decode(file_get_contents(__DIR__ . '/../../../resources/swagger-schema.json'));

        $refProvider = new Preloaded();
        $refProvider->setSchemaData('http://swagger.io/v2/schema.json', $schemaData);

        $options = new Context();
        $options->setRemoteRefProvider($refProvider);

        $swaggerSchema = Schema::import($schemaData, $options);

        $appPath = __DIR__ . '/../../Tmp/Swagger';
        $appNs = 'Swaggest\PhpCodeBuilder\Tests\Tmp\Swagger';

        $app = new PhpApp();
        $app->setNamespaceRoot($appNs, '.');

        $builder = new PhpBuilder();
        $builder->buildSetters = true;
        $builder->makeEnumConstants = true;

        $builder->classCreatedHook = new ClassCreatedHookCallback(function (PhpClass $class, $path, $schema) use ($app, $appNs) {
            $class->setNamespace($appNs);
            if ('#' === $path) {
                $class->setName('SwaggerSchema');
            } elseif ('#/definitions/' === substr($path, 0, strlen('#/definitions/'))) {
                $class->setName(PhpCode::makePhpName(substr($path, strlen('#/definitions/')), false));
            }
            $app->addClass($class);
        });

        $builder->getType($swaggerSchema);
        $app->clearOldFiles($appPath);
        $app->store($appPath);
    }

}