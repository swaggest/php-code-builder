<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swaggest\PhpCodeBuilder\Tests\Tmp\DuplicateSymbolDeclaration;

use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\Structure\ClassStructure;
use Swaggest\PhpCodeBuilder\Tests\Tmp\DuplicateSymbolDeclaration\InlineElements\SomeThing as SomeThing1;


class SomeThing extends ClassStructure
{
    /** @var SomeThing1[]|array */
    public $inlineElements;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->inlineElements = Schema::arr();
        $properties->inlineElements->items = new Schema();
        $properties->inlineElements->items->anyOf[0] = SomeThing1::schema();
        $ownerSchema->addPropertyMapping('inline_elements', self::names()->inlineElements);
        $ownerSchema->type = Schema::OBJECT;
        $ownerSchema->title = "Standalone Image";
    }

    /**
     * @param SomeThing1[]|array $inlineElements
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setInlineElements($inlineElements)
    {
        $this->inlineElements = $inlineElements;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */
}