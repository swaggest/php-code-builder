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
 * Non Bearer
 */
class HTTPSecuritySchemeOneOf1 extends ClassStructure
{
    const BEARER = 'bearer';

    /** @var mixed */
    public $scheme;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->scheme = new Schema();
        $properties->scheme->not = new Schema();
        $properties->scheme->not->enum = array(
            self::BEARER,
        );
        $ownerSchema->not = new Schema();
        $ownerSchema->not->required = array(
            self::names()->bearerFormat,
        );
        $ownerSchema->description = "Non Bearer";
    }

    /**
     * @param mixed $scheme
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setScheme($scheme)
    {
        $this->scheme = $scheme;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */
}