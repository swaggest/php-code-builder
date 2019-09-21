<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swaggest\PhpCodeBuilder\Tests\Tmp\OpenAPI3;

use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Exception\StringException;
use Swaggest\JsonSchema\Helper;
use Swaggest\JsonSchema\InvalidValue;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\Structure\ClassStructure;


/**
 * Validation schema for OpenAPI Specification 3.0.X.
 */
class OpenAPI3Schema extends ClassStructure
{
    const X_PROPERTY_PATTERN = '^x-';

    /** @var string */
    public $openapi;

    /** @var Info */
    public $info;

    /** @var ExternalDocumentation */
    public $externalDocs;

    /** @var Server[]|array */
    public $servers;

    /** @var string[][]|array[][]|array */
    public $security;

    /** @var Tag[]|array */
    public $tags;

    /** @var PathItem[]|Operation[][] */
    public $paths;

    /** @var Components */
    public $components;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->openapi = Schema::string();
        $properties->openapi->pattern = "^3\\.0\\.\\d(-.+)?$";
        $properties->info = Info::schema();
        $properties->externalDocs = ExternalDocumentation::schema();
        $properties->servers = Schema::arr();
        $properties->servers->items = Server::schema();
        $properties->security = Schema::arr();
        $properties->security->items = Schema::object();
        $properties->security->items->additionalProperties = Schema::arr();
        $properties->security->items->additionalProperties->items = Schema::string();
        $properties->security->items->setFromRef('#/definitions/SecurityRequirement');
        $properties->tags = Schema::arr();
        $properties->tags->items = Tag::schema();
        $properties->tags->uniqueItems = true;
        $properties->paths = Schema::object();
        $properties->paths->additionalProperties = false;
        $property43d9b4 = PathItem::schema();
        $properties->paths->setPatternProperty('^\\/', $property43d9b4);
        $x = new Schema();
        $properties->paths->setPatternProperty('^x-', $x);
        $properties->paths->setFromRef('#/definitions/Paths');
        $properties->components = Components::schema();
        $ownerSchema->type = Schema::OBJECT;
        $ownerSchema->additionalProperties = false;
        $x = new Schema();
        $ownerSchema->setPatternProperty('^x-', $x);
        $ownerSchema->id = "https://spec.openapis.org/oas/3.0/schema/2019-04-02";
        $ownerSchema->schema = "http://json-schema.org/draft-04/schema#";
        $ownerSchema->description = "Validation schema for OpenAPI Specification 3.0.X.";
        $ownerSchema->required = array(
            self::names()->openapi,
            self::names()->info,
            self::names()->paths,
        );
    }

    /**
     * @param string $openapi
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setOpenapi($openapi)
    {
        $this->openapi = $openapi;
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

    /**
     * @param ExternalDocumentation $externalDocs
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setExternalDocs(ExternalDocumentation $externalDocs)
    {
        $this->externalDocs = $externalDocs;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param Server[]|array $servers
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setServers($servers)
    {
        $this->servers = $servers;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param string[][]|array[][]|array $security
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setSecurity($security)
    {
        $this->security = $security;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param Tag[]|array $tags
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param PathItem[]|Operation[][] $paths
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setPaths($paths)
    {
        $this->paths = $paths;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param Components $components
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setComponents(Components $components)
    {
        $this->components = $components;
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