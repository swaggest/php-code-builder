<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swaggest\PhpCodeBuilder\Tests\Tmp\Example;

use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\Structure\ClassStructure;


/**
 * Built from #
 */
class User extends ClassStructure
{
    /** @var int */
    public $id;

    /** @var string */
    public $name;

    /** @var User */
    public $parent;

    /** @var User[]|array */
    public $children;

    /** @var Info */
    public $info;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->id = Schema::integer();
        $properties->name = Schema::string();
        $properties->parent = User::schema();
        $properties->children = Schema::arr();
        $properties->children->items = User::schema();
        $properties->info = Info::schema();
        $ownerSchema->type = Schema::OBJECT;
        $ownerSchema->setFromRef('#');
    }

    /**
     * @param int $id
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param string $name
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param User $parent
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setParent(User $parent)
    {
        $this->parent = $parent;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param User[]|array $children
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setChildren($children)
    {
        $this->children = $children;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param Info $info
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setInfo(Info $info)
    {
        $this->info = $info;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */
}