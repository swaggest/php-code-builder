<?php

namespace Swaggest\PhpCodeBuilder;

use Swaggest\CodeBuilder\PlaceholderString;

class NamedReference extends PhpTemplate
{
    /** @var string */
    public $name;

    /** @var PhpClassTraitInterface */
    public $class;

    /**
     * NamedReference constructor.
     * @param string $name
     * @param PhpClassTraitInterface $class
     */
    public function __construct($name, PhpClassTraitInterface $class)
    {
        $this->name = $name;
        $this->class = $class;
    }


    protected function toString()
    {
        return $this->class->getReference() . '::' . $this->name;
    }
}