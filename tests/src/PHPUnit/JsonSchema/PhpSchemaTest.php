<?php

namespace Swaggest\PhpCodeBuilder\Tests\PHPUnit\JsonSchema;

use Swaggest\JsonSchema\Schema;
use Swaggest\PhpCodeBuilder\JsonSchema\PhpBuilder;

class PhpSchemaTest extends \PHPUnit_Framework_TestCase
{
    public function testProperties()
    {
        $anotherSchema = Schema::object()
            ->setProperty('hello', Schema::boolean())
            ->setProperty('world', Schema::string());


        $schema = Schema::object()
            ->setProperty('sampleInt', Schema::integer())
            ->setProperty('sampleBool', Schema::boolean())
            ->setProperty('sampleString', Schema::string())
            ->setProperty('sampleNumber', Schema::number())
        ;
        $schema
            ->setProperty('sampleSelf', $schema)
            ->setProperty('another', $anotherSchema)
        ;


        $builder = new PhpBuilder();
        $type = $builder->getType($schema);

        $index = 0;

        foreach ($builder->getGeneratedClasses() as $class) {
            $class->class->setName('Beech' . ++$index);
        }

        foreach ($builder->getGeneratedClasses() as $class) {
            echo $class->class;
        }


        var_dump($type->renderPhpDocType());
    }


    public function testSimple()
    {
        $builder = new PhpBuilder();
        $this->assertSame('int', $builder->getType(Schema::integer())->renderPhpDocType());
        $this->assertSame('float', $builder->getType(Schema::number())->renderPhpDocType());
        $this->assertSame('string', $builder->getType(Schema::string())->renderPhpDocType());
        $this->assertSame('bool', $builder->getType(Schema::boolean())->renderPhpDocType());
        $this->assertSame('array', $builder->getType(Schema::arr())->renderPhpDocType());
        $this->assertSame('object', $builder->getType(Schema::object())->renderPhpDocType());
        $this->assertSame('null', $builder->getType(Schema::null())->renderPhpDocType());
    }

}