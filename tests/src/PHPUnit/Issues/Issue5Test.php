<?php

namespace Swaggest\PhpCodeBuilder\Tests\PHPUnit\Issues;

use Swaggest\JsonSchema\Exception\ObjectException;
use Swaggest\JsonSchema\Schema;
use Swaggest\PhpCodeBuilder\App\PhpApp;
use Swaggest\PhpCodeBuilder\JsonSchema\ClassHookCallback;
use Swaggest\PhpCodeBuilder\JsonSchema\PhpBuilder;
use Swaggest\PhpCodeBuilder\PhpClass;
use Swaggest\PhpCodeBuilder\Tests\Tmp\Issue5\Sample;

/**
 * @see https://github.com/swaggest/php-code-builder/issues/5
 */
class Issue5Test extends \PHPUnit_Framework_TestCase
{
    function testIssue5()
    {
        $schemaJson = <<<'JSON'
{
  "type": "object",
  "properties": {
    "foo": {
      "type": "string"
    },
    "bar": {
      "type": "string"
    }
  },
  "if": {
    "properties": {
      "foo": {
        "enum": [
          "bar"
        ]
      }
    }
  },
  "then": {
    "required": [
      "bar"
    ]
  }
}
JSON;

        $appPath = realpath(__DIR__ . '/../../Tmp') . '/Issue5';
        $appNs = 'Swaggest\PhpCodeBuilder\Tests\Tmp\\Issue5';

        $app = new PhpApp();
        $app->setNamespaceRoot($appNs, '.');

        $schema = Schema::import(json_decode($schemaJson));
        $builder = new PhpBuilder();
        $builder->buildSetters = false;
        $builder->makeEnumConstants = true;

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


    function testGeneratedInvalid()
    {
        $this->setExpectedException(ObjectException::class, 'Required property missing: bar, data: {"foo":"bar"} at #->$ref[#/definitions/Swaggest\PhpCodeBuilder\Tests\Tmp\Issue5\Sample]->then');
        Sample::import((object)array('foo' => 'bar'));
    }

    function testGeneratedValid()
    {
        Sample::import((object)array('foo' => 'bar', 'bar' => 'ok'));
        Sample::import((object)array('foo' => 'not-bar'));
    }

}