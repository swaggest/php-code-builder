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
 * Built from #/definitions/Info
 * @property string $description
 * @property string $termsOfService
 * @property Contact $contact
 * @property License $license
 */
class Info extends ClassStructure
{
    const X_PROPERTY_PATTERN = '^x-';

    /** @var string */
    public $title;

    /** @var string */
    public $version;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->title = Schema::string();
        $properties->description = Schema::string();
        $properties->termsOfService = Schema::string();
        $properties->termsOfService->format = "uri-reference";
        $properties->contact = Contact::schema();
        $properties->license = License::schema();
        $properties->version = Schema::string();
        $ownerSchema->type = Schema::OBJECT;
        $ownerSchema->additionalProperties = false;
        $x = new Schema();
        $ownerSchema->setPatternProperty('^x-', $x);
        $ownerSchema->required = array(
            self::names()->title,
            self::names()->version,
        );
        $ownerSchema->setFromRef('#/definitions/Info');
    }

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
     * @param string $termsOfService
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setTermsOfService($termsOfService)
    {
        $this->termsOfService = $termsOfService;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param Contact $contact
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setContact(Contact $contact)
    {
        $this->contact = $contact;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param License $license
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setLicense(License $license)
    {
        $this->license = $license;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param string $version
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setVersion($version)
    {
        $this->version = $version;
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