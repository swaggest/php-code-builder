<?php

namespace Swaggest\PhpCodeBuilder;


class PhpDoc extends PhpTemplate
{
    const TAG_PARAM = 'param';
    const TAG_FILE = 'file';
    const TAG_VAR = 'var';
    const TAG_PROPERTY = 'property';
    const TAG_RETURN = 'return';
    const TAG_CODE_COVERAGE_IGNORE_START = 'codeCoverageIgnoreStart';
    const TAG_CODE_COVERAGE_IGNORE_END = 'codeCoverageIgnoreEnd';

    /** @var PhpDocTag[] */
    private $tags = array();

    public function add($name, $value = '')
    {
        $this->tags[] = new PhpDocTag($name, $value);
        return $this;
    }

    protected function toString()
    {
        $result = '';
        foreach ($this->tags as $tag) {
            if ($tag->name) {
                $value = $tag->value ? $this->padLines(' * ', ' ' . $tag->value) : '';
                $result .= <<<PHP
 * @{$tag->name}{$value}

PHP;
            } else {
                $result .= $this->padLines(' * ', $tag->value, false) . "\n";
            }
        }
        if ($result) {
            $result = <<<PHP
/**
$result */

PHP;
        }
        return $result;
    }
}