<?php

namespace Swaggest\PhpCodeBuilder;


use Swaggest\PhpCodeBuilder\Traits\Description;

class PhpNamedVar
{
    use Description;

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

    public function renderArgumentType()
    {
        if ($this->type && $type = $this->type->renderArgumentType()) {
            return $type . ' ';
        }
        return '';
    }

    public function renderPhpDocValue($withName = false)
    {
        $tagValue = '';
        if ($this->type) {
            $tagValue .= $this->type->renderPhpDocType();
        }
        if ($withName) {
            $tagValue .= ' $' . $this->name;
        }
        if ($this->description) {
            $tagValue .= ' ' . $this->description;
        }
        return trim($tagValue);
    }
}