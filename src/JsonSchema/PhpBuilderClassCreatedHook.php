<?php

namespace Swaggest\PhpCodeBuilder\JsonSchema;

use Swaggest\JsonSchema\JsonSchema;
use Swaggest\PhpCodeBuilder\PhpClass;

interface PhpBuilderClassCreatedHook
{
    /**
     * @param PhpClass $class
     * @param $path
     * @param JsonSchema $schema
     * @return mixed
     */
    public function process(PhpClass $class, $path, $schema);
}