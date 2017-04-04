<?php

namespace Swaggest\PhpCodeBuilder;

class PhpStdType implements PhpAnyType
{
    const TYPE_INT = 'int';
    const TYPE_FLOAT = 'float';
    const TYPE_STRING = 'string';
    const TYPE_BOOL = 'bool';
    const TYPE_MIXED = 'mixed';
    const TYPE_OBJECT = 'object';
    const TYPE_ARRAY = 'array';
    const TYPE_NULL = 'null';

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

    public static function mixed()
    {
        return new self(self::TYPE_MIXED);
    }

    public static function object()
    {
        return new self(self::TYPE_OBJECT);
    }

    public static function arr()
    {
        return new self(self::TYPE_ARRAY);
    }

    public static function null()
    {
        return new self(self::TYPE_NULL);
    }


}