<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swaggest\PhpCodeBuilder\Tests\Tmp\OpenAPI3;

use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Context;
use Swaggest\JsonSchema\Exception\StringException;
use Swaggest\JsonSchema\Helper;
use Swaggest\JsonSchema\InvalidValue;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\Structure\ClassStructure;


/**
 * Built from #/definitions/HTTPSecurityScheme
 * @method static HTTPSecurityScheme|HTTPSecuritySchemeBearer|HTTPSecuritySchemeNonBearer import($data, Context $options = null)
 */
class HTTPSecurityScheme extends ClassStructure
{
    const HTTP = 'http';

    const X_PROPERTY_PATTERN = '^x-';

    /** @var string */
    public $scheme;

    /** @var string */
    public $bearerFormat;

    /** @var string */
    public $description;

    /** @var string */
    public $type;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->scheme = Schema::string();
        $properties->bearerFormat = Schema::string();
        $properties->description = Schema::string();
        $properties->type = Schema::string();
        $properties->type->enum = array(
            self::HTTP,
        );
        $ownerSchema->type = Schema::OBJECT;
        $ownerSchema->additionalProperties = false;
        $x = new Schema();
        $ownerSchema->setPatternProperty('^x-', $x);
        $ownerSchema->oneOf[0] = HTTPSecuritySchemeBearer::schema();
        $ownerSchema->oneOf[1] = HTTPSecuritySchemeNonBearer::schema();
        $ownerSchema->required = array(
            self::names()->scheme,
            self::names()->type,
        );
        $ownerSchema->setFromRef('#/definitions/HTTPSecurityScheme');
    }

    /**
     * @param string $scheme
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setScheme($scheme)
    {
        $this->scheme = $scheme;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param string $bearerFormat
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setBearerFormat($bearerFormat)
    {
        $this->bearerFormat = $bearerFormat;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param string $description
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param string $type
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @return array
     * @codeCoverageIgnoreStart
     */
    public function getXValues()
    {
        $result = array();
        if (!$names = $this->getPatternPropertyNames(self::X_PROPERTY_PATTERN)) {
            return $result;
        }
        foreach ($names as $name) {
            $result[$name] = $this->$name;
        }
        return $result;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param string $name
     * @param mixed $value
     * @return self
     * @throws InvalidValue
     * @codeCoverageIgnoreStart
     */
    public function setXValue($name, $value)
    {
        if (!preg_match(Helper::toPregPattern(self::X_PROPERTY_PATTERN), $name)) {
            throw new StringException('Pattern mismatch', StringException::PATTERN_MISMATCH);
        }
        $this->addPatternPropertyName(self::X_PROPERTY_PATTERN, $name);
        $this->{$name} = $value;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */
}