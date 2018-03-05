<?php

namespace Swaggest\PhpCodeBuilder\JsonSchema;

use Swaggest\CodeBuilder\PlaceholderString;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\SchemaExporter;
use Swaggest\PhpCodeBuilder\PhpClass;
use Swaggest\PhpCodeBuilder\PhpCode;
use Swaggest\PhpCodeBuilder\PhpFunction;
use Swaggest\PhpCodeBuilder\PhpInterface;
use Swaggest\PhpCodeBuilder\Types\TypeOf;

class SchemaExporterInterface
{
    public static function process(PhpClass $phpClass, Schema $schema)
    {
        $schemaProperties = Schema::properties();
        $className = PhpBuilder::getSchemaMeta($phpClass)->getFromRef();

        $propertiesFound = array();
        foreach ($phpClass->getProperties() as $property) {
            $schemaName = $property->getNamedVar()->getName();
            //$schemaName = $property->getMeta(PhpBuilder::PROPERTY_NAME);
            /** @var Schema $propertySchema */
            $propertySchema = $property->getMeta(PhpBuilder::SCHEMA);

            $schemaProperty = $schemaProperties[$schemaName];
            if ($schemaProperty !== null) {
                if (empty($schemaProperty->type)
                    || ($schemaProperty->type == $propertySchema->type)
                    || (is_array($schemaProperty->type) && in_array($propertySchema->type, $schemaProperty->type))
                ) {
                    $propertiesFound[] = $property->getNamedVar()->getName();
                } else {
                    echo 'a';
                }
            } else {
                //echo 'b';
            }
        }

        if (count($propertiesFound) > 5) {
            $func = new PhpFunction('exportSchema');
            $func->setResult(PhpClass::byFQN(Schema::class));
            $body = (new PhpCode())->addSnippet(new PlaceholderString(<<<PHP
\$schema = new :schema();

PHP
                , [':schema' => new TypeOf(PhpClass::byFQN(Schema::class))]
            ));

            foreach ($propertiesFound as $name) {
                $body->addSnippet(<<<PHP
\$schema->$name = \$this->$name;

PHP
);

            }

            $body->addSnippet(<<<'PHP'
$schema->setFromRef($this->getFromRef());
$schema->setDocumentPath($this->getDocumentPath());
$schema->addMeta($this, 'origin');
return $schema;
PHP
            );

            $func->setBody($body);
            $phpClass->addMethod($func);
            $phpClass->addImplements(PhpInterface::byFQN(SchemaExporter::class));
        }

    }

}