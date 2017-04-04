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

    public function __construct($name, PhpAnyType $type = null, $visibility = PhpFlags::VIS_PUBLIC)
    {
        $this->namedVar = new PhpNamedVar($name, $type);
        $this->visibility = $visibility;
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
{$this->renderPhpDoc()}{$this->renderVisibility()}{$this->renderIsStatic()}\${$this->namedVar->getName()};


PHP;

    }
}