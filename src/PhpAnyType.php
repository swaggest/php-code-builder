<?php

namespace Swaggest\PhpCodeBuilder;

interface PhpAnyType
{
    /**
     * @return string
     */
    public function renderArgumentType();

    /**
     * @return string
     */
    public function renderPhpDocType();


}