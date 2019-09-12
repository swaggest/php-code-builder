<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swaggest\PhpCodeBuilder\Tests\Tmp\OpenAPI3;

use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\Structure\ClassStructure;


/**
 * Parameter in header
 */
class ParameterLocationParameterInHeader extends ClassStructure
{
    const HEADER = 'header';

    const SIMPLE = 'simple';

    /** @var mixed */
    public $in;

    /** @var mixed */
    public $style;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->in = new Schema();
        $properties->in->enum = array(
            self::HEADER,
        );
        $properties->style = new Schema();
        $properties->style->enum = array(
            self::SIMPLE,
        );
        $properties->style->default = "simple";
        $ownerSchema->description = "Parameter in header";
    }

    /**
     * @param mixed $in
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setIn($in)
    {
        $this->in = $in;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param mixed $style
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setStyle($style)
    {
        $this->style = $style;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */
}