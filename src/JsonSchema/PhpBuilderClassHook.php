<?php

namespace Swaggest\PhpCodeBuilder\JsonSchema;

use Swaggest\JsonSchema\JsonSchema;
use Swaggest\PhpCodeBuilder\PhpClass;

interface PhpBuilderClassHook
{
    /**
     * @param PhpClass $class
     * @param string $path
     * @param JsonSchema $schema
     * @return mixed
     */
    public function process(PhpClass $class, $path, $schema);
}