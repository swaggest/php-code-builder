<?php

namespace Swaggest\PhpCodeBuilder\Tests\PHPUnit\JsonSchema;


use Swaggest\JsonSchema\SchemaLoader;
use Swaggest\PhpCodeBuilder\JsonSchema\PhpBuilder;

class JsonSchemaGenerateTest extends \PHPUnit_Framework_TestCase
{
    public function testJsonSchemaGenerate()
    {
        $schemaData = json_decode(file_get_contents(__DIR__ . '/../../../../../json-schema/spec/json-schema.json'));
        $schema = SchemaLoader::create()->readSchema($schemaData);

        $builder = new PhpBuilder();
        $builder->getType($schema);

        $index = 0;

        foreach ($builder->getGeneratedClasses() as $class) {
            $class->class->setName('Beech' . ++$index);
        }

        foreach ($builder->getGeneratedClasses() as $class) {
            echo $class->class;
        }


    }

}