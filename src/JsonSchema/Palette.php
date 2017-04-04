<?php

namespace Swaggest\PhpCodeBuilder\JsonSchema;

use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\Structure\ClassStructure;
use Swaggest\PhpCodeBuilder\PhpClass;
use Swaggest\PhpCodeBuilder\PhpDocType;
use Swaggest\PhpCodeBuilder\Types\OrType;

class Palette
{
    public static function classStructureClass()
    {
        static $instance;
        if (null === $instance) {
            $instance = new PhpClass();
            $instance->setFullyQualifiedName(ClassStructure::className());
        }
        return $instance;
    }

    public static function propertiesOrStaticClass()
    {
        static $instance;
        if (null === $instance) {
            $class = new PhpClass();
            $class->setFullyQualifiedName(get_class(new Properties()));
            $instance = new OrType();
            $instance->add($class);
            $instance->add(PhpDocType::staticType());
        }
        return $instance;
    }

    public static function schemaClass()
    {
        static $instance;
        if (null === $instance) {
            $instance = new PhpClass();
            $instance->setFullyQualifiedName(get_class(new Schema()));
        }
        return $instance;
    }

}