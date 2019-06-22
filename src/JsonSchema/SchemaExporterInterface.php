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

            $names = Schema::names();
            foreach ($propertiesFound as $name) {
                if ($name === $names->items
                    || $name === $names->additionalProperties
                    || $name === $names->additionalItems
                    || $name === $names->not
                    || $name === $names->if
                    || $name === $names->then
                    || $name === $names->else) {
                    $body->addSnippet(<<<PHP
if (\$this->$name !== null && \$this->$name instanceof SchemaExporter) {
    \$schema->$name = \$this->{$name}->exportSchema();
}

PHP
                    );
                    continue;
                }

                if ($name === $names->allOf || $name === $names->oneOf || $name === $names->anyOf) {
                    $body->addSnippet(<<<PHP
if (!empty(\$this->$name)) {
    foreach (\$this->$name as \$i => \$item) {
        if (\$item instanceof SchemaExporter) {
            \$schema->{$name}[\$i] = \$item->exportSchema();
        }
    }
}

PHP
                    );
                    continue;
                }


                if ($name === $names->properties) {
                    $body->addSnippet(<<<PHP
if (!empty(\$this->$name)) {
    foreach (\$this->$name as \$propertyName => \$propertySchema) {
        if (is_string(\$propertyName) && \$propertySchema instanceof SchemaExporter) {
            \$schema->setProperty(\$propertyName, \$propertySchema->exportSchema());
        }
    }
}

PHP
                    );
                    continue;
                }


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