<?php

namespace Swaggest\PhpCodeBuilder\Tests\PHPUnit\Swagger;


use Swaggest\JsonSchema\Schema;
use Swaggest\PhpCodeBuilder\Tests\Tmp\Swagger\SwaggerSchema;

class ExportTest extends \PHPUnit_Framework_TestCase
{
    public function testExport() {
        $schema = SwaggerSchema::schema()->exportSchema();
        $schemaData = Schema::export($schema);
        echo json_encode($schemaData, JSON_PRETTY_PRINT + JSON_UNESCAPED_SLASHES);
    }

}