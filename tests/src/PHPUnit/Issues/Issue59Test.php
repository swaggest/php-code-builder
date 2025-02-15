<?php

namespace Swaggest\PhpCodeBuilder\Tests\PHPUnit\Issues;

use Swaggest\JsonSchema\Exception\ConstException;
use Swaggest\JsonSchema\Exception\ObjectException;
use Swaggest\JsonSchema\Schema;
use Swaggest\PhpCodeBuilder\App\PhpApp;
use Swaggest\PhpCodeBuilder\JsonSchema\ClassHookCallback;
use Swaggest\PhpCodeBuilder\JsonSchema\PhpBuilder;
use Swaggest\PhpCodeBuilder\PhpClass;
use Swaggest\PhpCodeBuilder\Tests\Tmp\Issue59\Sample;

/**
 * @see https://github.com/swaggest/php-code-builder/issues/59
 */
class Issue59Test extends \PHPUnit_Framework_TestCase
{
    function testIssue59()
    {
        $schemaJson = <<<'JSON'
{
  "type": "object",
  "description": "Description with $dollar sign",
  "properties": {
    "foo": {
      "type": "string"
    }
  }
}
JSON;

        $appPath = realpath(__DIR__ . '/../../Tmp') . '/Issue59';
        $appNs = 'Swaggest\PhpCodeBuilder\Tests\Tmp\\Issue59';

        $app = new PhpApp();
        $app->setNamespaceRoot($appNs, '.');

        $schema = Schema::import(json_decode($schemaJson));
        $builder = new PhpBuilder();
        $builder->buildSetters = false;
        $builder->makeEnumConstants = true;
        $builder->skipSchemaDescriptions = false;

        $builder->classCreatedHook = new ClassHookCallback(
            function (PhpClass $class, $path, $schema) use ($app, $appNs) {
                $class->setNamespace($appNs);
                if ('#' === $path) {
                    $class->setName('Sample'); // Class name for root schema
                }
                $app->addClass($class);
            }
        );


        $builder->getType($schema);

        $app->clearOldFiles($appPath);
        $app->store($appPath);

        exec('git diff ' . $appPath, $out);
        $out = implode("\n", $out);
        $this->assertSame('', $out, "Generated files changed");
    }


    function testGeneratedValid()
    {
        Sample::import((object)array('foo' => 'abc'));
    }

}