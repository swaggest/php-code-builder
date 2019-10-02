<?php

namespace Swaggest\PhpCodeBuilder;


use Swaggest\PhpCodeBuilder\Traits\Description;

class PhpNamedVar
{
    use Description;

    /** @var string */
    private $name;

    /** @var PhpAnyType|null */
    private $type;

    /** @var bool */
    private $hasDefault;

    /** @var mixed */
    private $default;

    /**
     * PhpNamedVar constructor.
     * @param string $name
     * @param PhpAnyType $type
     * @param bool $hasDefault
     * @param null $default
     */
    public function __construct($name, PhpAnyType $type = null, $hasDefault = false, $default = null)
    {
        $this->name = $name;
        $this->type = $type;
        $this->hasDefault = $hasDefault;
        $this->default = $default;
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
     * @return PhpAnyType|null
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

    /**
     * @param mixed $value
     * @return $this
     */
    public function setDefault($value)
    {
        $this->hasDefault = true;
        $this->default = $value;
        return $this;
    }

    /**
     * @return $this
     */
    public function clearDefault()
    {
        $this->hasDefault = false;
        return $this;
    }

    public function renderDefault()
    {
        if (!$this->hasDefault) {
            return '';
        }

        if ($this->default instanceof PhpTemplate) {
            $result = $this->default->render();
        } else {
            $result = var_export($this->default, true);
        }

        return ' = ' . $result;
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
        $phpDocType = '';
        if ($this->type) {
            $phpDocType = $this->type->renderPhpDocType();
        }
        if (!trim($phpDocType)) {
            $phpDocType = PhpStdType::TYPE_MIXED;
        }
        $tagValue .= $phpDocType;
        if ($withName) {
            $tagValue .= ' $' . $this->name;
        }
        if ($this->description) {
            $tagValue .= ' ' . $this->description;
        }
        return trim($tagValue);
    }
}