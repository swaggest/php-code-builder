<?php

namespace Swaggest\PhpCodeBuilder\Traits;


use Swaggest\PhpCodeBuilder\PhpDoc;

trait Description
{
    use PhpDocable;

    /** @var string */
    private $description;

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    private function renderDescriptionAsPhpDoc()
    {
        if ($this->description) {
            $this->getPhpDoc()->prepend(null, trim($this->description));
            return $this->getPhpDoc()->render();
        } else {
            return '';
        }
    }

}