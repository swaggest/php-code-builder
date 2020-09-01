<?php

namespace Swaggest\PhpCodeBuilder\Tests\PHPUnit\JsonSchema;


use Swaggest\JsonSchema\Exception\StringException;
use Swaggest\JsonSchema\Schema;
use Swaggest\PhpCodeBuilder\App\PhpApp;
use Swaggest\PhpCodeBuilder\JsonSchema\ClassHookCallback;
use Swaggest\PhpCodeBuilder\JsonSchema\PhpBuilder;
use Swaggest\PhpCodeBuilder\PhpClass;
use Swaggest\PhpCodeBuilder\Tests\Tmp\DuplicateSymbolDeclaration\SomeThing;
use Swaggest\PhpCodeBuilder\Tests\Tmp\DuplicateSymbolDeclaration\InlineElements\SomeThing as InlineElementSomeThing;

class DuplicateSymbolDeclarationTest extends \PHPUnit_Framework_TestCase
{
    private $nsItem = "DuplicateSymbolDeclaration";

    public function testGeneration()
    {
        $schemaData = json_decode(file_get_contents(__DIR__ . '/../../../resources/duplicate-symbol-declaration-schema.json'));
        $schema = Schema::import($schemaData);

        $appPath = realpath(__DIR__ . '/../../Tmp') . '/' . $this->nsItem;
        $appNs = 'Swaggest\PhpCodeBuilder\Tests\Tmp\\' . $this->nsItem;

        $app = new PhpApp();
        $app->setNamespaceRoot($appNs, '.');

        $builder = new PhpBuilder();
        $builder->buildSetters = true;
        $builder->makeEnumConstants = true;

        $builder->classCreatedHook = new ClassHookCallback(
            function (PhpClass $class, $path, $schema) use ($app, $appNs) {
                $namespace = $schema->{'meta:namespace'};
                $class->setNamespace($appNs . ($namespace ? '\\' . $namespace : ''));
                $class->setName($schema->{'meta:class'});
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


    public function testGeneratedEntity()
    {
        $data = (object)[
            'inline_elements' => [
                (object)[
                    'width' => 640,
                    'height' => 480,
                ],
            ],
        ];

        $s = SomeThing::import($data);

        $this->assertInstanceOf(SomeThing::class, $s);
        $this->assertCount(1, $s->inlineElements);
        $this->assertInstanceOf(
            InlineElementSomeThing::class,
            $s->inlineElements[0]
        );
        $this->assertEquals(640, $s->inlineElements[0]->width);
    }

}