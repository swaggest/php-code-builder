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
 * Bearer
 * @property mixed $scheme
 */
class HTTPSecuritySchemeBearer extends ClassStructure
{
    const BEARER = 'bearer';

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->scheme = new Schema();
        $properties->scheme->enum = array(
            self::BEARER,
        );
        $ownerSchema->description = "Bearer";
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