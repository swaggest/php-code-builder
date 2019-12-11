<?php

namespace Swaggest\PhpCodeBuilder;

use Swaggest\PhpCodeBuilder\Traits\Description;

class PhpTrait extends PhpTemplate
{
    use Description;

    /** @var string  */
    protected $name;

    /**
     * PhpTrait constructor.
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    protected function toString()
    {
        return <<<PHP
{$this->renderDescriptionAsPhpDoc()}use {$this->name};


PHP;
    }
}