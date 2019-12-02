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
 * Built from #/definitions/MediaType
 * @method static MediaType import($data, Context $options = null)
 * @property mixed $example
 */
class MediaType extends ClassStructure
{
    const X_PROPERTY_PATTERN = '^x-';

    /** @var DefinitionsSchema|string[] */
    public $schema;

    /** @var Example[]|string[][] */
    public $examples;

    /** @var Encoding[] */
    public $encoding;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->schema = new Schema();
        $properties->schema->oneOf[0] = DefinitionsSchema::schema();
        $propertiesSchemaOneOf1 = Schema::object();
        $ref = Schema::string();
        $ref->format = "uri-reference";
        $propertiesSchemaOneOf1->setPatternProperty('^\\$ref$', $ref);
        $propertiesSchemaOneOf1->not = new Schema();
        $propertiesSchemaOneOf1->not->description = "References are removed from validation because of proactive dereferencing";
        $propertiesSchemaOneOf1->required = array(
            '$ref',
        );
        $propertiesSchemaOneOf1->setFromRef('#/definitions/Reference');
        $properties->schema->oneOf[1] = $propertiesSchemaOneOf1;
        $properties->example = new Schema();
        $properties->examples = Schema::object();
        $properties->examples->additionalProperties = new Schema();
        $properties->examples->additionalProperties->oneOf[0] = Example::schema();
        $propertiesExamplesAdditionalPropertiesOneOf1 = Schema::object();
        $ref = Schema::string();
        $ref->format = "uri-reference";
        $propertiesExamplesAdditionalPropertiesOneOf1->setPatternProperty('^\\$ref$', $ref);
        $propertiesExamplesAdditionalPropertiesOneOf1->not = new Schema();
        $propertiesExamplesAdditionalPropertiesOneOf1->not->description = "References are removed from validation because of proactive dereferencing";
        $propertiesExamplesAdditionalPropertiesOneOf1->required = array(
            '$ref',
        );
        $propertiesExamplesAdditionalPropertiesOneOf1->setFromRef('#/definitions/Reference');
        $properties->examples->additionalProperties->oneOf[1] = $propertiesExamplesAdditionalPropertiesOneOf1;
        $properties->encoding = Schema::object();
        $properties->encoding->additionalProperties = Encoding::schema();
        $ownerSchema->type = Schema::OBJECT;
        $ownerSchema->additionalProperties = false;
        $x = new Schema();
        $ownerSchema->setPatternProperty('^x-', $x);
        $ownerSchemaAllOf0 = new Schema();
        $ownerSchemaAllOf0->not = new Schema();
        $ownerSchemaAllOf0->not->required = array(
            self::names()->example,
            self::names()->examples,
        );
        $ownerSchemaAllOf0->description = "Example and examples are mutually exclusive";
        $ownerSchemaAllOf0->setFromRef('#/definitions/ExampleXORExamples');
        $ownerSchema->allOf[0] = $ownerSchemaAllOf0;
        $ownerSchema->setFromRef('#/definitions/MediaType');
    }

    /**
     * @param DefinitionsSchema|string[] $schema
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setSchema($schema)
    {
        $this->schema = $schema;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param mixed $example
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setExample($example)
    {
        $this->example = $example;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param Example[]|string[][] $examples
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setExamples($examples)
    {
        $this->examples = $examples;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param Encoding[] $encoding
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setEncoding($encoding)
    {
        $this->encoding = $encoding;
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