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
 * Built from #/definitions/Encoding
 */
class Encoding extends ClassStructure
{
    const FORM = 'form';

    const SPACE_DELIMITED = 'spaceDelimited';

    const PIPE_DELIMITED = 'pipeDelimited';

    const DEEP_OBJECT = 'deepObject';

    /** @var string */
    public $contentType;

    /** @var Header[]|mixed[] */
    public $headers;

    /** @var string */
    public $style;

    /** @var bool */
    public $explode;

    /** @var bool */
    public $allowReserved;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->contentType = Schema::string();
        $properties->headers = Schema::object();
        $properties->headers->additionalProperties = Header::schema();
        $properties->style = Schema::string();
        $properties->style->enum = array(
            self::FORM,
            self::SPACE_DELIMITED,
            self::PIPE_DELIMITED,
            self::DEEP_OBJECT,
        );
        $properties->explode = Schema::boolean();
        $properties->allowReserved = Schema::boolean();
        $properties->allowReserved->default = false;
        $ownerSchema->type = 'object';
        $ownerSchema->additionalProperties = false;
        $ownerSchema->setFromRef('#/definitions/Encoding');
    }

    /**
     * @param string $contentType
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setContentType($contentType)
    {
        $this->contentType = $contentType;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param Header[]|mixed[] $headers
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param string $style
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setStyle($style)
    {
        $this->style = $style;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param bool $explode
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setExplode($explode)
    {
        $this->explode = $explode;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param bool $allowReserved
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setAllowReserved($allowReserved)
    {
        $this->allowReserved = $allowReserved;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */
}