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
            if ($type instanceof OrType) {
                $phpDocType = $type->renderArrayPhpDocType();
                if ($phpDocType) {
                    $index[$phpDocType] = 1;
                }
            } else {
                $phpDocType = $type->renderPhpDocType();
                if ($phpDocType) {
                    $index[$phpDocType . '[]'] = 1;
                }
            }
        }
        return implode('|', array_keys($index));
    }


    public function add(PhpAnyType $type = null)
    {
        if ($type !== null) {
            $this->types[] = $type;
        }
        return $this;
    }

    /**
     * @return $this|PhpAnyType
     */
    public function simplify() {
        if (count($this->types) === 1) {
            return $this->types[0];
        } else {
            return $this;
        }
    }
}