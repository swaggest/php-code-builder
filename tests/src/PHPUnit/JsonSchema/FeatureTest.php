<?php

namespace Swaggest\PhpCodeBuilder\Tests\PHPUnit\JsonSchema;


use Swaggest\JsonSchema\Schema;
use Swaggest\PhpCodeBuilder\App\PhpApp;
use Swaggest\PhpCodeBuilder\JsonSchema\ClassHookCallback;
use Swaggest\PhpCodeBuilder\JsonSchema\PhpBuilder;
use Swaggest\PhpCodeBuilder\PhpClass;
use Swaggest\PhpCodeBuilder\Tests\Tmp\Entity\Entity;

class FeatureTest extends \PHPUnit_Framework_TestCase
{
    private $nsItem = "Entity";

    public function testGeneration()
    {
        $schemaData = json_decode(file_get_contents(__DIR__ . '/../../../resources/entity-schema.json'));
        $schema = Schema::import($schemaData);

        $appPath = realpath(__DIR__ . '/../../Tmp') . '/' . $this->nsItem;
        $appNs = 'Swaggest\PhpCodeBuilder\Tests\Tmp\\' . $this->nsItem;

        $app = new PhpApp();
        $app->setNamespaceRoot($appNs, '.');

        $builder = new PhpBuilder();
        $builder->buildSetters = true;
        $builder->makeEnumConstants = true;

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
                $class->setName('Entity');
            } elseif ('#/definitions/' === substr($path, 0, strlen('#/definitions/'))) {
                $className = PhpCode::makePhpClassName(substr($path, strlen('#/definitions/')));
                if ($className === 'Schema') {
                    $className = 'DefinitionsSchema';
                }
                $class->setName($className);
            }
            $app->addClass($class);
        });

        $builder->getType($schema);
        $app->clearOldFiles($appPath);
        $app->store($appPath);

        exec('git diff ' . $appPath, $out);
        $out = implode("\n", $out);
        $this->assertSame('', $out, "Generated files changed");

    }


    public function testGeneratedEntity()
    {
        $e = new Entity();

        $e->namedProperty = "foo";
        $this->assertSame("foo", $e->namedProperty);
        $this->assertSame($e, $e->setNamedProperty("bar"));
        $this->assertSame("bar", $e->namedProperty);

        $exported = Entity::export($e);
        $this->assertEquals((object)['namedProperty$$$#%' => 'bar'], $exported);

        $data = (object)[
            'x-sample' => 1,
            'z-sample' => true,
            'foo1' => 'bar1',
            'foo2' => 'bar2',
        ];
        $e = Entity::import($data);
        $this->assertEquals(['x-sample' => 1], $e->getXValues());
        $this->assertEquals(['z-sample' => true], $e->getZValues());

        $this->assertEquals(['foo1' => 'bar1', 'foo2' => 'bar2'], $e->getAdditionalPropertyValues());

        $e->setAdditionalPropertyValue('foo3', 'bar3');
        $this->assertEquals(['foo1' => 'bar1', 'foo2' => 'bar2', 'foo3' => 'bar3'], $e->getAdditionalPropertyValues());

        // TODO validate on set in json schema
        $e->{'x-sample'} = 1;
        $e->{'z-sample'} = "one";


    }

}