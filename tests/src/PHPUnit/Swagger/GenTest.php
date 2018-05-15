<?php

namespace Swaggest\PhpCodeBuilder\Tests\PHPUnit\Swagger;

use Swaggest\JsonSchema\Context;
use Swaggest\JsonSchema\RemoteRef\Preloaded;
use Swaggest\JsonSchema\Schema;
use Swaggest\PhpCodeBuilder\App\PhpApp;
use Swaggest\PhpCodeBuilder\JsonSchema\ClassHookCallback;
use Swaggest\PhpCodeBuilder\JsonSchema\PhpBuilder;
use Swaggest\PhpCodeBuilder\JsonSchema\SchemaExporterInterface;
use Swaggest\PhpCodeBuilder\PhpClass;
use Swaggest\PhpCodeBuilder\PhpCode;

class GenTest extends \PHPUnit_Framework_TestCase
{
    protected $minimizeRefs = false;
    protected $nsItem = 'Swagger';

    public function testGenerateSwagger()
    {
        $schemaData = json_decode(file_get_contents(__DIR__ . '/../../../resources/swagger-schema.json'));

        $refProvider = new Preloaded();
        $refProvider->setSchemaData('http://swagger.io/v2/schema.json', $schemaData);

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
        $builder->minimizeRefs = $this->minimizeRefs;

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
                $class->setName('SwaggerSchema');
            } elseif ('#/definitions/' === substr($path, 0, strlen('#/definitions/'))) {
                $class->setName(PhpCode::makePhpClassName(substr($path, strlen('#/definitions/'))));
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

}