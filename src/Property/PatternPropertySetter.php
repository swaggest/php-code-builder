<?php

namespace Swaggest\PhpCodeBuilder\Property;


use Swaggest\CodeBuilder\PlaceholderString;
use Swaggest\JsonSchema\Exception\StringException;
use Swaggest\JsonSchema\Helper;
use Swaggest\JsonSchema\InvalidValue;
use Swaggest\PhpCodeBuilder\PhpAnyType;
use Swaggest\PhpCodeBuilder\PhpClass;
use Swaggest\PhpCodeBuilder\PhpCode;
use Swaggest\PhpCodeBuilder\PhpConstant;
use Swaggest\PhpCodeBuilder\PhpFlags;
use Swaggest\PhpCodeBuilder\PhpFunction;
use Swaggest\PhpCodeBuilder\PhpNamedVar;
use Swaggest\PhpCodeBuilder\PhpStdType;
use Swaggest\PhpCodeBuilder\Types\TypeOf;

class PatternPropertySetter extends PhpFunction
{
    public function __construct(PhpConstant $patternConst, PhpAnyType $type)
    {
        $name = PhpCode::makePhpName($patternConst->getValue(), false);
        parent::__construct('set' . $name . 'Value', PhpFlags::VIS_PUBLIC);

        $this->addArgument(new PhpNamedVar('name', PhpStdType::string()));
        $this->addArgument(new PhpNamedVar('value', $type));

        $this->skipCodeCoverage = true;
        $this->addThrows(PhpClass::byFQN(InvalidValue::class));

        $this->setResult(PhpStdType::tSelf());
        $this->setBody(
            new PlaceholderString(<<<PHP
if (preg_match(:helper::toPregPattern(self::{$patternConst->getName()}), \$name)) {
    throw new StringException('Pattern mismatch', :stringException::PATTERN_MISMATCH);
}
\$this->addPatternPropertyName(self::{$patternConst->getName()}, \$name);
\$this->{\$name} = \$value;
return \$this;

PHP
                ,
                array(
                    ':stringException' => new TypeOf(PhpClass::byFQN(StringException::class)),
                    ':helper' => new TypeOf(PhpClass::byFQN(Helper::class)),
                ))
        );
    }
}