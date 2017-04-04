<?php

namespace Swaggest\PhpCodeBuilder;


class PhpDocType implements PhpAnyType
{
    private $type;

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
        return $this->type;
    }

    private function __construct($type)
    {
        $this->type = $type;
    }

    public static function staticType()
    {
        return new self('static');
    }

    public static function selfType()
    {
        return new self('self');
    }

    public static function thisType()
    {
        return new self('$this');
    }

}