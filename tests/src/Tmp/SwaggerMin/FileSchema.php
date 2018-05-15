<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swaggest\PhpCodeBuilder\Tests\Tmp\SwaggerMin;

use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Context;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\SchemaExporter;
use Swaggest\JsonSchema\Structure\ClassStructure;


/**
 * A deterministic version of a JSON Schema object.
 * Built from #/definitions/fileSchema
 * @method static FileSchema import($data, Context $options=null)
 */
class FileSchema extends ClassStructure implements SchemaExporter {
	const FILE = 'file';

	/** @var string */
	public $format;

	/** @var string */
	public $title;

	/** @var string */
	public $description;

	public $default;

	/** @var string[]|array */
	public $required;

	/** @var string */
	public $type;

	/** @var bool */
	public $readOnly;

	/** @var ExternalDocs information about external documentation */
	public $externalDocs;

	public $example;

	/**
	 * @param Properties|static $properties
	 * @param Schema $ownerSchema
	 */
	public static function setUpProperties($properties, Schema $ownerSchema)
	{
		$properties->format = Schema::string();
		$properties->title = Schema::string();
		$properties->title->setFromRef('http://json-schema.org/draft-04/schema#/properties/title');
		$properties->description = Schema::string();
		$properties->description->setFromRef('http://json-schema.org/draft-04/schema#/properties/description');
		$properties->default = new Schema();
		$properties->default->setFromRef('http://json-schema.org/draft-04/schema#/properties/default');
		$properties->required = Schema::arr();
		$properties->required->items = Schema::string();
		$properties->required->minItems = 1;
		$properties->required->uniqueItems = true;
		$properties->required->setFromRef('http://json-schema.org/draft-04/schema#/definitions/stringArray');
		$properties->type = Schema::string();
		$properties->type->enum = array(
		    self::FILE,
		);
		$properties->readOnly = Schema::boolean();
		$properties->readOnly->default = false;
		$properties->externalDocs = ExternalDocs::schema();
		$properties->example = new Schema();
		$ownerSchema->type = 'object';
		$ownerSchema->additionalProperties = false;
		$patternProperty = new Schema();
		$patternProperty->additionalProperties = true;
		$patternProperty->additionalItems = true;
		$patternProperty->description = "Any property starting with x- is valid.";
		$patternProperty->setFromRef('#/definitions/vendorExtension');
		$ownerSchema->setPatternProperty('^x-', $patternProperty);
		$ownerSchema->description = "A deterministic version of a JSON Schema object.";
		$ownerSchema->required = array (
		  0 => 'type',
		);
		$ownerSchema->setFromRef('#/definitions/fileSchema');
	}

	/**
	 * @param string $format
	 * @return $this
	 * @codeCoverageIgnoreStart
	 */
	public function setFormat($format)
	{
		$this->format = $format;
		return $this;
	}
	/** @codeCoverageIgnoreEnd */

	/**
	 * @param string $title
	 * @return $this
	 * @codeCoverageIgnoreStart
	 */
	public function setTitle($title)
	{
		$this->title = $title;
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
	 * @param $default
	 * @return $this
	 * @codeCoverageIgnoreStart
	 */
	public function setDefault($default)
	{
		$this->default = $default;
		return $this;
	}
	/** @codeCoverageIgnoreEnd */

	/**
	 * @param string[]|array $required
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
	 * @param bool $readOnly
	 * @return $this
	 * @codeCoverageIgnoreStart
	 */
	public function setReadOnly($readOnly)
	{
		$this->readOnly = $readOnly;
		return $this;
	}
	/** @codeCoverageIgnoreEnd */

	/**
	 * @param ExternalDocs $externalDocs information about external documentation
	 * @return $this
	 * @codeCoverageIgnoreStart
	 */
	public function setExternalDocs($externalDocs)
	{
		$this->externalDocs = $externalDocs;
		return $this;
	}
	/** @codeCoverageIgnoreEnd */

	/**
	 * @param $example
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
	 * @return Schema
	 */
	function exportSchema()
	{
		$schema = new Schema();
		$schema->format = $this->format;
		$schema->title = $this->title;
		$schema->description = $this->description;
		$schema->default = $this->default;
		$schema->required = $this->required;
		$schema->type = $this->type;
		$schema->__fromRef = $this->__fromRef;
		$schema->setDocumentPath($this->getDocumentPath());
		$schema->addMeta($this, 'origin');
		return $schema;
	}
}