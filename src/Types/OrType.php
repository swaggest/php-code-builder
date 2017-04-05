<?php

namespace Swaggest\PhpCodeBuilder\Types;

use Swaggest\PhpCodeBuilder\PhpAnyType;

class OrType implements PhpAnyType
{
    /** @var PhpAnyType[] */
    private $types = array();

    /**
     * @return string
     */
    public function renderArgumentType()
    {
        return '';
    }

    /**
     * @return string
     */
    public function renderPhpDocType()
    {
        $index = array();
        foreach ($this->types as $type) {
            $phpDocType = $type->renderPhpDocType();
            if ($phpDocType) {
                $index[$phpDocType] = 1;
            }
        }
        return implode('|', array_keys($index));
    }

    /**
     * @return string
     */
    public function renderArrayPhpDocType()
    {
        $index = array();
        foreach ($this->types as $type) {
            $phpDocType = $type->renderPhpDocType();
            if ($phpDocType) {
                $index[$phpDocType . '[]'] = 1;
            }
        }
        return implode('|', array_keys($index));
    }


    public function add(PhpAnyType $type)
    {
        $this->types[] = $type;
        return $this;
    }

}