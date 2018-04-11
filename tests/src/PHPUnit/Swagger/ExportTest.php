<?php

namespace Swaggest\PhpCodeBuilder\Tests\PHPUnit\Swagger;


use Swaggest\JsonDiff\JsonDiff;
use Swaggest\JsonSchema\Schema;
use Swaggest\PhpCodeBuilder\Tests\Tmp\Swagger\SwaggerSchema;

class ExportTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @throws \Swaggest\JsonDiff\Exception
     * @throws \Swaggest\JsonSchema\InvalidValue
     */
    public function testExport() {
        $schema = SwaggerSchema::schema()->exportSchema();
        $schemaData = Schema::export($schema);

        $diff = new JsonDiff(
            json_decode(file_get_contents(__DIR__ . '/../../../resources/swagger-schema.json')),
            $schemaData
        );

        $result = json_encode($diff->getRearranged(), JSON_PRETTY_PRINT + JSON_UNESCAPED_SLASHES);
        echo $result;
        file_put_contents(__DIR__ . '/../../../resources/swagger-schema-gen.json', $result);
    }

}