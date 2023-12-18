<?php

namespace Swaggest\PhpCodeBuilder\Traits;

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
            $this->getPhpDoc()->prepend(null, trim(wordwrap($this->description)), 'description');
            return $this->getPhpDoc()->render();
        } else {
            return '';
        }
    }

}