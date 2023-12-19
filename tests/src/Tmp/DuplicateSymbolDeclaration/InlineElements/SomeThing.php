<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swaggest\PhpCodeBuilder\Tests\Tmp\DuplicateSymbolDeclaration\InlineElements;

use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\Structure\ClassStructure;


/**
 * @property float $height
 * @property float $width
 */
class SomeThing extends ClassStructure
{
    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->height = Schema::number();
        $properties->width = Schema::number();
        $ownerSchema->type = Schema::OBJECT;
        $ownerSchema->setFromRef('#/definitions/InlineElementImage');
    }

    /**
     * @param float $height
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setHeight($height)
    {
        $this->height = $height;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param float $width
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setWidth($width)
    {
        $this->width = $width;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */
}