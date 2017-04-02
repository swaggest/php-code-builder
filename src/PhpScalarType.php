<?php

namespace Swaggest\PhpCodeBuilder;

class PhpScalarType implements PhpAnyType
{
    const TYPE_INT = 'int';
    const TYPE_FLOAT = 'float';
    const TYPE_STRING = 'string';
    const TYPE_BOOL = 'bool';

    private $type;

    public function renderArgumentType()
    {
        return '';
    }

    public function renderPhpDocType()
    {
        return $this->type;
    }

    private function __construct($type)
    {
        $this->type = $type;
    }

    public static function int()
    {
        return new self(self::TYPE_INT);
    }

    public static function float()
    {
        return new self(self::TYPE_FLOAT);
    }

    public static function bool()
    {
        return new self(self::TYPE_BOOL);
    }

    public static function string()
    {
        return new self(self::TYPE_STRING);
    }
}