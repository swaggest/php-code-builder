<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swaggest\PhpCodeBuilder\Tests\Tmp\SwaggerMin;

use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Exception\StringException;
use Swaggest\JsonSchema\Helper;
use Swaggest\JsonSchema\InvalidValue;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\Structure\ClassStructure;


/**
 * Built from #/definitions/pathItem
 */
class PathItem extends ClassStructure
{
    const X_PROPERTY_PATTERN = '^x-';

    /** @var string */
    public $ref;

    /** @var Operation */
    public $get;

    /** @var Operation */
    public $put;

    /** @var Operation */
    public $post;

    /** @var Operation */
    public $delete;

    /** @var Operation */
    public $options;

    /** @var Operation */
    public $head;

    /** @var Operation */
    public $patch;

    /** @var BodyParameter[]|HeaderParameterSubSchema[]|FormDataParameterSubSchema[]|QueryParameterSubSchema[]|PathParameterSubSchema[]|JsonReference[]|array The parameters needed to send a valid API call. */
    public $parameters;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->ref = Schema::string();
        $ownerSchema->addPropertyMapping('$ref', self::names()->ref);
        $properties->get = Operation::schema();
        $properties->put = Operation::schema();
        $properties->post = Operation::schema();
        $properties->delete = Operation::schema();
        $properties->options = Operation::schema();
        $properties->head = Operation::schema();
        $properties->patch = Operation::schema();
        $properties->parameters = Schema::arr();
        $properties->parameters->additionalItems = false;
        $properties->parameters->items = new Schema();
        $propertiesParametersItemsOneOf0 = new Schema();
        $propertiesParametersItemsOneOf0->oneOf[0] = BodyParameter::schema();
        $propertiesParametersItemsOneOf0OneOf1 = Schema::object();
        $propertiesParametersItemsOneOf0OneOf1->oneOf[0] = HeaderParameterSubSchema::schema();
        $propertiesParametersItemsOneOf0OneOf1->oneOf[1] = FormDataParameterSubSchema::schema();
        $propertiesParametersItemsOneOf0OneOf1->oneOf[2] = QueryParameterSubSchema::schema();
        $propertiesParametersItemsOneOf0OneOf1->oneOf[3] = PathParameterSubSchema::schema();
        $propertiesParametersItemsOneOf0OneOf1->required = array(
            0 => 'name',
            1 => 'in',
            2 => 'type',
        );
        $propertiesParametersItemsOneOf0OneOf1->setFromRef('#/definitions/nonBodyParameter');
        $propertiesParametersItemsOneOf0->oneOf[1] = $propertiesParametersItemsOneOf0OneOf1;
        $propertiesParametersItemsOneOf0->setFromRef('#/definitions/parameter');
        $properties->parameters->items->oneOf[0] = $propertiesParametersItemsOneOf0;
        $properties->parameters->items->oneOf[1] = JsonReference::schema();
        $properties->parameters->description = "The parameters needed to send a valid API call.";
        $properties->parameters->uniqueItems = true;
        $properties->parameters->setFromRef('#/definitions/parametersList');
        $ownerSchema->type = 'object';
        $ownerSchema->additionalProperties = false;
        $patternProperty = new Schema();
        $patternProperty->additionalProperties = true;
        $patternProperty->additionalItems = true;
        $patternProperty->description = "Any property starting with x- is valid.";
        $patternProperty->setFromRef('#/definitions/vendorExtension');
        $ownerSchema->setPatternProperty('^x-', $patternProperty);
        $ownerSchema->setFromRef('#/definitions/pathItem');
    }

    /**
     * @param string $ref
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setRef($ref)
    {
        $this->ref = $ref;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param Operation $get
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setGet(Operation $get)
    {
        $this->get = $get;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param Operation $put
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setPut(Operation $put)
    {
        $this->put = $put;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param Operation $post
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setPost(Operation $post)
    {
        $this->post = $post;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param Operation $delete
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setDelete(Operation $delete)
    {
        $this->delete = $delete;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param Operation $options
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setOptions(Operation $options)
    {
        $this->options = $options;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param Operation $head
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setHead(Operation $head)
    {
        $this->head = $head;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param Operation $patch
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setPatch(Operation $patch)
    {
        $this->patch = $patch;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param BodyParameter[]|HeaderParameterSubSchema[]|FormDataParameterSubSchema[]|QueryParameterSubSchema[]|PathParameterSubSchema[]|JsonReference[]|array $parameters The parameters needed to send a valid API call.
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setParameters($parameters)
    {
        $this->parameters = $parameters;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
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