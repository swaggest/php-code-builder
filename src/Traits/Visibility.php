<?php

namespace Swaggest\PhpCodeBuilder\Traits;

trait Visibility
{
    private $visibility;

    private function renderVisibility()
    {
        if ($this->visibility) {
            return $this->visibility . ' ';
        } else {
            return '';
        }
    }

    /**
     * @return string
     */
    public function getVisibility()
    {
        return $this->visibility;
    }

    /**
     * @param string $visibility
     * @return $this
     */
    public function setVisibility($visibility)
    {
        $this->visibility = $visibility;
        return $this;
    }

}