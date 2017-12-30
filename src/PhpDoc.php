<?php

namespace Swaggest\PhpCodeBuilder;


class PhpDoc extends PhpTemplate
{
    const TAG_PARAM = 'param';
    const TAG_FILE = 'file';
    const TAG_VAR = 'var';
    const TAG_PROPERTY = 'property';
    const TAG_RETURN = 'return';
    const TAG_THROWS = 'throws';
    const TAG_METHOD = 'method';
    const TAG_CODE_COVERAGE_IGNORE_START = 'codeCoverageIgnoreStart';
    const TAG_CODE_COVERAGE_IGNORE_END = 'codeCoverageIgnoreEnd';

    /** @var PhpDocTag[] */
    private $tags = array();

    public function add($name, $value = '')
    {
        $this->tags[] = new PhpDocTag($name, $value);
        return $this;
    }

    public function prepend($name, $value = '')
    {
        array_unshift($this->tags, new PhpDocTag($name, $value));
        return $this;
    }

    public function isEmpty()
    {
        return empty($this->tags);
    }

    protected function toString()
    {
        $result = '';
        foreach ($this->tags as $tag) {
            if ($tag->name) {
                if ($tag->name === 'method') {
                    echo '.';
                }
                $value = $tag->value ? $this->padLines(' * ', ' ' . $tag->value, true, true) : '';
                $result .= <<<PHP
 * @{$tag->name}{$value}

PHP;
            } else {
                $result .= $this->padLines(' * ', $tag->value, false, true) . "\n";
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