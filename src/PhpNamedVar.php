<?php

namespace Swaggest\PhpCodeBuilder;


class PhpNamedVar extends PhpTemplate
{
    /** @var string */
    private $name;

    /** @var PhpAnyType */
    private $type;

    /**
     * PhpNamedVar constructor.
     * @param string $name
     * @param PhpAnyType $type
     */
    public function __construct($name, PhpAnyType $type = null)
    {
        $this->name = $name;
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return PhpNamedVar
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return PhpAnyType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param PhpAnyType $type
     * @return PhpNamedVar
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }




    protected function toString()
    {
        // TODO: Implement toString() method.
    }

    public function renderArgumentType()
    {
        if ($this->type) {
            return $this->type->renderArgumentType();
        }
        return '';
    }
}