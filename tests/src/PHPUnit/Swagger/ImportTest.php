<?php

namespace Swaggest\PhpCodeBuilder\Tests\PHPUnit\Swagger;

use Swaggest\JsonSchema\Context;
use Swaggest\JsonSchema\RemoteRef\Preloaded;
use Swaggest\JsonSchema\Schema;
use Swaggest\PhpCodeBuilder\Tests\Tmp\Swagger\SwaggerSchema;

class ImportTest extends \PHPUnit_Framework_TestCase
{
    public function testImport()
    {
        SwaggerSchema::import(
            json_decode(file_get_contents(__DIR__ . '/../../../resources/circleci.json')),
            new Context(new Preloaded())
        );
    }

    public function testImportMin()
    {
        \Swaggest\PhpCodeBuilder\Tests\Tmp\SwaggerMin\SwaggerSchema::import(
            json_decode(file_get_contents(__DIR__ . '/../../../resources/circleci.json')),
            new Context(new Preloaded())
        );
    }

    public function testImportRaw()
    {
        $swaggerSchema = Schema::import(
            json_decode(file_get_contents(__DIR__ . '/../../../resources/swagger-schema.json')),
            new Context(new Preloaded())
        );
        $swaggerSchema->in(json_decode(file_get_contents(__DIR__ . '/../../../resources/circleci.json')));
    }

    public function testReimport()
    {
        $swaggerSchema = Schema::import(
            json_decode(file_get_contents(__DIR__ . '/../../../resources/swagger-schema-gen.json')),
            new Context(new Preloaded())
        );
        $swaggerSchema->in(json_decode(file_get_contents(__DIR__ . '/../../../resources/circleci.json')));
    }

    public function testReimportMin()
    {
        $swaggerSchema = Schema::import(
            json_decode(file_get_contents(__DIR__ . '/../../../resources/swagger-schema-gen-min.json')),
            new Context(new Preloaded())
        );
        $swaggerSchema->in(json_decode(file_get_contents(__DIR__ . '/../../../resources/circleci.json')));
    }

}