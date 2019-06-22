<?php

namespace Swaggest\PhpCodeBuilder\Types;

use Swaggest\PhpCodeBuilder\PhpAnyType;
use Swaggest\PhpCodeBuilder\PhpStdType;

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
                $phpDocParts = explode('|', $phpDocType);
                foreach ($phpDocParts as $k => $part) {
                    if ($part !== PhpStdType::TYPE_MIXED) {
                        $index[$phpDocType] = 1;
                    }
                }
            }
        }
        $phpDocType = implode('|', array_keys($index));
        if ($phpDocType === '') {
            $phpDocType = PhpStdType::TYPE_MIXED;
        }
        return $phpDocType;
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
    public function simplify()
    {
        if (count($this->types) === 1) {
            return $this->types[0];
        } else {
            return $this;
        }
    }

    public function getTypes()
    {
        return $this->types;
    }
}