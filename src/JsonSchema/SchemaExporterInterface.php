<?php

namespace Swaggest\PhpCodeBuilder\JsonSchema;

use Swaggest\CodeBuilder\PlaceholderString;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\SchemaExporter;
use Swaggest\JsonSchema\Wrapper;
use Swaggest\PhpCodeBuilder\PhpClass;
use Swaggest\PhpCodeBuilder\PhpCode;
use Swaggest\PhpCodeBuilder\PhpFunction;
use Swaggest\PhpCodeBuilder\PhpInterface;
use Swaggest\PhpCodeBuilder\Types\TypeOf;

/**
 * Implements SchemaExporter if class has at least 5 intersecting properties with JsonSchema
 */
class SchemaExporterInterface implements PhpBuilderClassHook
{
    public function process(PhpClass $class, $path, $schema)
    {
        $schemaProperties = Schema::properties();

        $propertiesFound = array();
        foreach ($class->getProperties() as $property) {
            $schemaName = $property->getNamedVar()->getName();
            //$schemaName = $property->getMeta(PhpBuilder::PROPERTY_NAME);
            /** @var Schema $propertySchema */
            $propertySchema = $property->getMeta(PhpBuilder::SCHEMA);

            $schemaProperty = $schemaProperties[$schemaName];
            if ($schemaProperty instanceof SchemaExporter) {
                $schemaProperty = $schemaProperty->exportSchema();
            }
            if ($schemaProperty !== null) {
                if (empty($schemaProperty->type)
                    || ($schemaProperty->type == $propertySchema->type)
                    || (is_array($schemaProperty->type) && in_array($propertySchema->type, $schemaProperty->type))
                ) {
                    $propertiesFound[] = $property->getNamedVar()->getName();
                }
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
$schema->__fromRef = $this->__fromRef;
$schema->setDocumentPath($this->getDocumentPath());
$schema->addMeta($this, 'origin');
return $schema;
PHP
            );

            $func->setBody($body);
            $class->addMethod($func);
            $class->addImplements(PhpInterface::byFQN(SchemaExporter::class));
        }

    }

}