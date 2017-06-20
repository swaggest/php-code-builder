<?php

namespace Swaggest\PhpCodeBuilder;

class PhpDocTag extends PhpTemplate
{

    public $name;
    public $value;

    /**
     * PhpDocTag constructor.
     * @param $name
     * @param $value
     */
    public function __construct($name, $value = '')
    {
        $this->name = $name;
        $this->value = $value;
    }

    protected function toString()
    {
        return <<<PHP
/** @{$this->name} {$this->value} */
PHP;

    }
}