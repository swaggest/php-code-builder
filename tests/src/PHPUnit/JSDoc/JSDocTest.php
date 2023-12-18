<?php

namespace Swaggest\PhpCodeBuilder\Tests\PHPUnit\JSDoc;

use Swaggest\JsonSchema\Schema;
use Swaggest\PhpCodeBuilder\JSDoc\TypeBuilder;

class JSDocTest extends \PHPUnit_Framework_TestCase
{
    public function testJsonSchema()
    {
        $schemaData = <<<'JSON'
{
    "$ref": "#/definitions/Person",
    "definitions": {
        "Person": {
            "type": "object",
            "properties": {
                "name": {"type": "string", "title":"     Name    ", "description": "The name of the person."},
                "age": {"type": "integer"},
                "isMale": {"type": "boolean"},
                "partner": {"$ref": "#/definitions/Person"},
                "children": {"type":"array", "items": {"$ref":"#/definitions/Person"}}
            }
        }
    }
}
JSON;
        $schema = Schema::import(json_decode($schemaData));
        $this->assertNotEmpty($schema);

        $tb = new TypeBuilder();

        $typeString = $tb->getTypeString($schema);
        $this->assertSame('Person', $typeString);
        $this->assertSame(<<<'JS'
/**
 * @typedef Person
 * @type {Object}
 * @property {String} name - Name. The name of the person.
 * @property {Number} age
 * @property {Boolean} isMale
 * @property {Person} partner
 * @property {Array<Person>} children
 */


JS
, $tb->file);
    }

}