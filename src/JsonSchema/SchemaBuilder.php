<?php

namespace Swaggest\PhpCodeBuilder\JsonSchema;


use Swaggest\CodeBuilder\PlaceholderString;
use Swaggest\JsonSchema\Constraint\Type;
use Swaggest\JsonSchema\Schema;
use Swaggest\PhpCodeBuilder\Types\PhpDocTypeOf;

class SchemaBuilder
{
    public function build(Schema $schema, $varName)
    {
        $schema->toArray();
        $result = "$varName = ";

        switch ($schema->type) {
            case Type::INTEGER:
                $result .= '::schema::integer();';
                break;

            case Type::NUMBER:
                $result .= '::schema::number();';
                break;

            case Type::BOOLEAN:
                $result .= '::schema::boolean();';
                break;

            case Type::STRING:
                $result .= '::schema::string();';
                break;

            case Type::ARR:
                $result .= '::schema::arr();';
                break;

            case Type::OBJECT:
                $result .= '::schema::object();';
                break;
        }

        return new PlaceholderString($result . "\n", array(
            '::schema' => new PhpDocTypeOf(Palette::schemaClass()),
        ));

    }
}