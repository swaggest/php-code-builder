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
    const TAG_SEE = 'see';
    const TAG_CODE_COVERAGE_IGNORE_START = 'codeCoverageIgnoreStart';
    const TAG_CODE_COVERAGE_IGNORE_END = 'codeCoverageIgnoreEnd';

    /** @var PhpDocTag[] */
    private $tags = array();

    public function add($name, $value = '', $id = null)
    {
        if ($id) {
            $this->tags[$id] = new PhpDocTag($name, $value);
        } else {
            $this->tags[] = new PhpDocTag($name, $value);
        }
        return $this;
    }

    public function removeById($id)
    {
        if (isset($this->tags[$id])) {
            unset($this->tags[$id]);
        }
        return $this;
    }

    public function prepend($name, $value = '', $id = null)
    {
        $tags = array();
        if ($id) {
            $tags[$id] = new PhpDocTag($name, $value);
            foreach ($this->tags as $k => $tag) {
                if ($k === $id) {
                    continue;
                }
                $tags[$k] = $tag;
            }
            $this->tags = $tags;
            return $this;
        } else {
            array_unshift($this->tags, new PhpDocTag($name, $value));
            return $this;
        }
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