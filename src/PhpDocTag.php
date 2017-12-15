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
        $value = trim($this->value);
        $value = $value ? ' ' . $value : '';
        if (strpos($value, "\n") !== false) {
            return <<<PHP
/**
 * @{$this->name}{$this->padLines(' * ', $value)}
 */
PHP;
        } else {
            return <<<PHP
/** @{$this->name}{$value} */
PHP;
        }

    }
}