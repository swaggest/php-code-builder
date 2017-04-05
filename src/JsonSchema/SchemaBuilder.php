<?php

namespace Swaggest\PhpCodeBuilder\JsonSchema;


use Swaggest\CodeBuilder\PlaceholderString;
use Swaggest\JsonSchema\Constraint\Type;
use Swaggest\JsonSchema\Schema;
use Swaggest\PhpCodeBuilder\Types\ReferenceTypeOf;

class SchemaBuilder
{
    public function build(Schema $schema, $varName)
    {
        if ($schema->ref !== null) {
            return $this->build($schema->ref->getSchema(), $varName);
        }

        $schema->toArray();
        $result = "$varName = ";

        if ($schema->type !== null) {
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

                case Type::NULL:
                    $result .= '::schema::null();';
                    break;

                default:
                    var_dump($schema->type);
                    throw new Exception('Unknown type');
            }
        } else {
            $result .= 'new ::schema();';
        }


        /*
        $schemaData = SchemaLoader::create()->dumpSchema($schema);
        if (isset($schemaData->type) && !is_array($schemaData->type)) {
            unset($schemaData->type);
        }
        */

        return new PlaceholderString($result . "\n", array(
            '::schema' => new ReferenceTypeOf(Palette::schemaClass()),
        ));

    }
}