<?php

namespace Swaggest\PhpCodeBuilder\Traits;

trait StaticFlag
{
    /** @var bool */
    private $isStatic;

    private function renderIsStatic()
    {
        if ($this->isStatic) {
            return 'static ';
        } else {
            return '';
        }
    }

    /**
     * @return bool
     */
    public function getIsStatic()
    {
        return $this->isStatic;
    }

    /**
     * @param bool $isStatic
     * @return $this
     */
    public function setIsStatic($isStatic)
    {
        $this->isStatic = $isStatic;
        return $this;
    }

}