<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swaggest\PhpCodeBuilder\Tests\Tmp\Swagger;

use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Context;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\Structure\ClassStructure;


/**
 * Built from #/definitions/securityDefinitions
 * @method static BasicAuthenticationSecurity[]|ApiKeySecurity[]|Oauth2ImplicitSecurity[]|Oauth2PasswordSecurity[]|Oauth2ApplicationSecurity[]|Oauth2AccessCodeSecurity[] import($data, Context $options = null)
 */
class SecurityDefinitions extends ClassStructure
{
    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $ownerSchema->type = Schema::OBJECT;
        $ownerSchema->additionalProperties = new Schema();
        $ownerSchema->additionalProperties->oneOf[0] = BasicAuthenticationSecurity::schema();
        $ownerSchema->additionalProperties->oneOf[1] = ApiKeySecurity::schema();
        $ownerSchema->additionalProperties->oneOf[2] = Oauth2ImplicitSecurity::schema();
        $ownerSchema->additionalProperties->oneOf[3] = Oauth2PasswordSecurity::schema();
        $ownerSchema->additionalProperties->oneOf[4] = Oauth2ApplicationSecurity::schema();
        $ownerSchema->additionalProperties->oneOf[5] = Oauth2AccessCodeSecurity::schema();
        $ownerSchema->setFromRef('#/definitions/securityDefinitions');
    }

    /**
     * @return BasicAuthenticationSecurity[]|ApiKeySecurity[]|Oauth2ImplicitSecurity[]|Oauth2PasswordSecurity[]|Oauth2ApplicationSecurity[]|Oauth2AccessCodeSecurity[]
     * @codeCoverageIgnoreStart
     */
    public function getAdditionalPropertyValues()
    {
        $result = array();
        if (!$names = $this->getAdditionalPropertyNames()) {
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
     * @param BasicAuthenticationSecurity|ApiKeySecurity|Oauth2ImplicitSecurity|Oauth2PasswordSecurity|Oauth2ApplicationSecurity|Oauth2AccessCodeSecurity $value
     * @return self
     * @codeCoverageIgnoreStart
     */
    public function setAdditionalPropertyValue($name, $value)
    {
        $this->addAdditionalPropertyName($name);
        $this->{$name} = $value;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */
}