<?php

namespace Swaggest\PhpCodeBuilder\Property;

use Swaggest\PhpCodeBuilder\PhpClassProperty;
use Swaggest\PhpCodeBuilder\PhpDocType;
use Swaggest\PhpCodeBuilder\PhpFlags;
use Swaggest\PhpCodeBuilder\PhpFunction;

class Setter extends PhpFunction
{
    /**
     * Getter constructor.
     * @param PhpClassProperty $property
     * @param bool $fluent
     */
    public function __construct(PhpClassProperty $property, $fluent = true)
    {
        $name = $property->getNamedVar()->getName();
        parent::__construct(
            'set' . ucfirst($name),
            PhpFlags::VIS_PUBLIC
        );

        $this->addArgument($property->getNamedVar());

        $body = <<<PHP
\$this->{$name} = \${$name};

PHP;

        if ($fluent) {
            $this->setResult(PhpDocType::thisType());
            $body .= <<<PHP
return \$this;

PHP;

        }

        $this->setBody($body);

    }
}