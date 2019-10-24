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
 * Built from #/definitions/Header
 * @method static Header import($data, Context $options = null)
 * @property mixed $example
 */
class Header extends ClassStructure
{
    const SIMPLE = 'simple';

    const X_PROPERTY_PATTERN = '^x-';

    /** @var string */
    public $description;

    /** @var bool */
    public $required;

    /** @var bool */
    public $deprecated;

    /** @var bool */
    public $allowEmptyValue;

    /** @var string */
    public $style;

    /** @var bool */
    public $explode;

    /** @var bool */
    public $allowReserved;

    /** @var DefinitionsSchema|string[] */
    public $schema;

    /** @var MediaType[]|mixed[] */
    public $content;

    /** @var Example[]|string[][] */
    public $examples;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->description = Schema::string();
        $properties->required = Schema::boolean();
        $properties->required->default = false;
        $properties->deprecated = Schema::boolean();
        $properties->deprecated->default = false;
        $properties->allowEmptyValue = Schema::boolean();
        $properties->allowEmptyValue->default = false;
        $properties->style = Schema::string();
        $properties->style->enum = array(
            self::SIMPLE,
        );
        $properties->style->default = "simple";
        $properties->explode = Schema::boolean();
        $properties->allowReserved = Schema::boolean();
        $properties->allowReserved->default = false;
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
        $properties->content = Schema::object();
        $properties->content->additionalProperties = MediaType::schema();
        $properties->content->maxProperties = 1;
        $properties->content->minProperties = 1;
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
        $ownerSchemaAllOf1 = new Schema();
        $ownerSchemaAllOf1->not = new Schema();
        $ownerSchemaAllOf1->not->required = array(
            self::names()->schema,
            self::names()->content,
        );
        $ownerSchemaAllOf1OneOf0 = new Schema();
        $ownerSchemaAllOf1OneOf0->required = array(
            self::names()->schema,
        );
        $ownerSchemaAllOf1->oneOf[0] = $ownerSchemaAllOf1OneOf0;
        $ownerSchemaAllOf1OneOf1 = new Schema();
        $ownerSchemaAllOf1OneOf1AllOf0 = new Schema();
        $ownerSchemaAllOf1OneOf1AllOf0->not = new Schema();
        $ownerSchemaAllOf1OneOf1AllOf0->not->required = array(
            self::names()->style,
        );
        $ownerSchemaAllOf1OneOf1->allOf[0] = $ownerSchemaAllOf1OneOf1AllOf0;
        $ownerSchemaAllOf1OneOf1AllOf1 = new Schema();
        $ownerSchemaAllOf1OneOf1AllOf1->not = new Schema();
        $ownerSchemaAllOf1OneOf1AllOf1->not->required = array(
            self::names()->explode,
        );
        $ownerSchemaAllOf1OneOf1->allOf[1] = $ownerSchemaAllOf1OneOf1AllOf1;
        $ownerSchemaAllOf1OneOf1AllOf2 = new Schema();
        $ownerSchemaAllOf1OneOf1AllOf2->not = new Schema();
        $ownerSchemaAllOf1OneOf1AllOf2->not->required = array(
            self::names()->allowReserved,
        );
        $ownerSchemaAllOf1OneOf1->allOf[2] = $ownerSchemaAllOf1OneOf1AllOf2;
        $ownerSchemaAllOf1OneOf1AllOf3 = new Schema();
        $ownerSchemaAllOf1OneOf1AllOf3->not = new Schema();
        $ownerSchemaAllOf1OneOf1AllOf3->not->required = array(
            self::names()->example,
        );
        $ownerSchemaAllOf1OneOf1->allOf[3] = $ownerSchemaAllOf1OneOf1AllOf3;
        $ownerSchemaAllOf1OneOf1AllOf4 = new Schema();
        $ownerSchemaAllOf1OneOf1AllOf4->not = new Schema();
        $ownerSchemaAllOf1OneOf1AllOf4->not->required = array(
            self::names()->examples,
        );
        $ownerSchemaAllOf1OneOf1->allOf[4] = $ownerSchemaAllOf1OneOf1AllOf4;
        $ownerSchemaAllOf1OneOf1->description = "Some properties are not allowed if content is present";
        $ownerSchemaAllOf1OneOf1->required = array(
            self::names()->content,
        );
        $ownerSchemaAllOf1->oneOf[1] = $ownerSchemaAllOf1OneOf1;
        $ownerSchemaAllOf1->description = "Schema and content are mutually exclusive, at least one is required";
        $ownerSchemaAllOf1->setFromRef('#/definitions/SchemaXORContent');
        $ownerSchema->allOf[1] = $ownerSchemaAllOf1;
        $ownerSchema->setFromRef('#/definitions/Header');
    }

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
     * @param bool $required
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
     * @param bool $deprecated
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setDeprecated($deprecated)
    {
        $this->deprecated = $deprecated;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param bool $allowEmptyValue
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setAllowEmptyValue($allowEmptyValue)
    {
        $this->allowEmptyValue = $allowEmptyValue;
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
     * @param MediaType[]|mixed[] $content
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setContent($content)
    {
        $this->content = $content;
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