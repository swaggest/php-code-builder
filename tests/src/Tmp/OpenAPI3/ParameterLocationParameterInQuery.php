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
 * Parameter in query
 */
class ParameterLocationParameterInQuery extends ClassStructure
{
    const QUERY = 'query';

    const FORM = 'form';

    const SPACE_DELIMITED = 'spaceDelimited';

    const PIPE_DELIMITED = 'pipeDelimited';

    const DEEP_OBJECT = 'deepObject';

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
            self::QUERY,
        );
        $properties->style = new Schema();
        $properties->style->enum = array(
            self::FORM,
            self::SPACE_DELIMITED,
            self::PIPE_DELIMITED,
            self::DEEP_OBJECT,
        );
        $properties->style->default = "form";
        $ownerSchema->description = "Parameter in query";
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