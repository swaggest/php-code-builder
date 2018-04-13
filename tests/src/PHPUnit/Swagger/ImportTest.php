<?php

namespace Swaggest\PhpCodeBuilder\Tests\PHPUnit\Swagger;


use Swaggest\JsonSchema\Schema;
use Swaggest\PhpCodeBuilder\Tests\Tmp\Swagger\SwaggerSchema;

class ImportTest extends \PHPUnit_Framework_TestCase
{
    public function testImport()
    {
        $schema = SwaggerSchema::import(json_decode(file_get_contents(__DIR__ . '/../../../resources/circleci.json')));
    }

    public function testImportRaw()
    {
        $swaggerSchema = Schema::import(json_decode(file_get_contents(__DIR__ . '/../../../resources/swagger-schema.json')));
        $swaggerSchema->in(json_decode(file_get_contents(__DIR__ . '/../../../resources/circleci.json')));
    }

    public function testImportRaw2()
    {
        $swaggerSchema = Schema::import(json_decode(file_get_contents(__DIR__ . '/../../../resources/swagger-schema-gen.json')));
        $swaggerSchema->in(json_decode(file_get_contents(__DIR__ . '/../../../resources/circleci.json')));
    }

}