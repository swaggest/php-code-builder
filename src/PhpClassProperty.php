<?php

namespace Swaggest\PhpCodeBuilder;


use Swaggest\PhpCodeBuilder\Traits\Description;
use Swaggest\PhpCodeBuilder\Traits\StaticFlag;
use Swaggest\PhpCodeBuilder\Traits\Visibility;

class PhpClassProperty extends PhpTemplate
{
    use Visibility;
    use StaticFlag;

    /** @var PhpNamedVar */
    private $namedVar;

    /** @var bool Magical property is rendered as phpdoc */
    private $isMagical = false;

    /**
     * @return bool
     */
    public function isMagical()
    {
        return $this->isMagical;
    }

    /**
     * @param bool $isMagical
     */
    public function setIsMagical($isMagical)
    {
        $this->isMagical = $isMagical;
    }

    public function __construct($name, PhpAnyType $type = null, $visibility = PhpFlags::VIS_PUBLIC)
    {
        $this->namedVar = new PhpNamedVar($name, $type);
        $this->visibility = $visibility;
    }



    /**
     * @param mixed $value
     * @return $this
     */
    public function setDefault($value)
    {
        $this->namedVar->setDefault($value);
        return $this;
    }

    /**
     * @return $this
     */
    public function clearDefault()
    {
        $this->namedVar->clearDefault();
        return $this;
    }

    /**
     * @return PhpNamedVar
     */
    public function getNamedVar()
    {
        return $this->namedVar;
    }

    /**
     * @param PhpNamedVar $namedVar
     * @return PhpClassProperty
     */
    public function setNamedVar($namedVar)
    {
        $this->namedVar = $namedVar;
        return $this;
    }

    public function setDescription($description)
    {
        $this->namedVar->setDescription($description);
        return $this;
    }

    private function renderPhpDoc()
    {
        if ($tagValue = $this->namedVar->renderPhpDocValue()) {
            return (new PhpDocTag(PhpDoc::TAG_VAR, $tagValue)) . "\n";
        }

        return '';
    }

    protected function toString()
    {
        return <<<PHP
{$this->renderPhpDoc()}{$this->renderVisibility()}{$this->renderIsStatic()}\${$this->namedVar->getName()}{$this->namedVar->renderDefault()};


PHP;

    }
}