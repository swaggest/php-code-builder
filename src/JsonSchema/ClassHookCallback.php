<?php

namespace Swaggest\PhpCodeBuilder\JsonSchema;

use Swaggest\PhpCodeBuilder\PhpClass;

class ClassHookCallback implements PhpBuilderClassHook
{
    /**
     * @var \Closure
     */
    private $callback;

    /**
     * ClassCreatedHookCallback constructor.
     * @param \Closure $callback
     */
    public function __construct(\Closure $callback)
    {
        $this->callback = $callback;
    }

    public function process(PhpClass $class, $path, $schema)
    {
        $this->callback->__invoke($class, $path, $schema);
    }
}