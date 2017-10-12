<?php

namespace Swaggest\PhpCodeBuilder\Traits;


use Swaggest\PhpCodeBuilder\PhpDoc;

trait Description
{
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
            $doc = new PhpDoc();
            $doc->add(null, $this->description);
            return $doc->render();
        } else {
            return '';
        }
    }

}