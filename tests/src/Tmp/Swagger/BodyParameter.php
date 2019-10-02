<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swaggest\PhpCodeBuilder\Tests\Tmp\Swagger;

use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Exception\StringException;
use Swaggest\JsonSchema\Helper;
use Swaggest\JsonSchema\InvalidValue;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\Structure\ClassStructure;


/**
 * Built from #/definitions/bodyParameter
 */
class BodyParameter extends ClassStructure
{
    const BODY = 'body';

    const X_PROPERTY_PATTERN = '^x-';

    /** @var string A brief description of the parameter. This could contain examples of use.  GitHub Flavored Markdown is allowed. */
    public $description;

    /** @var string The name of the parameter. */
    public $name;

    /** @var string Determines the location of the parameter. */
    public $in;

    /** @var bool Determines whether or not this parameter is required or optional. */
    public $required;

    /** @var DefinitionsSchema A deterministic version of a JSON Schema object. */
    public $schema;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->description = Schema::string();
        $properties->description->description = "A brief description of the parameter. This could contain examples of use.  GitHub Flavored Markdown is allowed.";
        $properties->name = Schema::string();
        $properties->name->description = "The name of the parameter.";
        $properties->in = Schema::string();
        $properties->in->enum = array(
            self::BODY,
        );
        $properties->in->description = "Determines the location of the parameter.";
        $properties->required = Schema::boolean();
        $properties->required->description = "Determines whether or not this parameter is required or optional.";
        $properties->required->default = false;
        $properties->schema = DefinitionsSchema::schema();
        $ownerSchema->type = Schema::OBJECT;
        $ownerSchema->additionalProperties = false;
        $x = VendorExtension::schema();
        $ownerSchema->setPatternProperty('^x-', $x);
        $ownerSchema->required = array(
            self::names()->name,
            self::names()->in,
            self::names()->schema,
        );
        $ownerSchema->setFromRef('#/definitions/bodyParameter');
    }

    /**
     * @param string $description A brief description of the parameter. This could contain examples of use.  GitHub Flavored Markdown is allowed.
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
     * @param string $name The name of the parameter.
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
     * @param string $in Determines the location of the parameter.
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
     * @param bool $required Determines whether or not this parameter is required or optional.
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setRequired($required)
    {
        $this->required = $required;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param DefinitionsSchema $schema A deterministic version of a JSON Schema object.
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setSchema(DefinitionsSchema $schema)
    {
        $this->schema = $schema;
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
        if (preg_match(Helper::toPregPattern(self::X_PROPERTY_PATTERN), $name)) {
            throw new StringException('Pattern mismatch', StringException::PATTERN_MISMATCH);
        }
        $this->addPatternPropertyName(self::X_PROPERTY_PATTERN, $name);
        $this->{$name} = $value;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */
}