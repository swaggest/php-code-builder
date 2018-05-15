<?php

namespace Swaggest\PhpCodeBuilder;

use Swaggest\PhpCodeBuilder\Traits\Description;
use Swaggest\PhpCodeBuilder\Traits\Visibility;

class PhpConstant extends PhpTemplate
{
    use Visibility;
    use Description;

    protected $name;
    private $value;

    /**
     * PhpConstant constructor.
     * @param string $name
     * @param string $value
     */
    public function __construct($name, $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    protected function toString()
    {
        $val = var_export($this->value, true);
        return <<<PHP
{$this->renderDescriptionAsPhpDoc()}{$this->renderVisibility()}const {$this->name} = $val;


PHP;

    }


}