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
 * Built from #/definitions/OAuthFlows
 */
class OAuthFlows extends ClassStructure
{
    const X_PROPERTY_PATTERN = '^x-';

    /** @var ImplicitOAuthFlow */
    public $implicit;

    /** @var PasswordOAuthFlow */
    public $password;

    /** @var ClientCredentialsFlow */
    public $clientCredentials;

    /** @var AuthorizationCodeOAuthFlow */
    public $authorizationCode;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->implicit = ImplicitOAuthFlow::schema();
        $properties->password = PasswordOAuthFlow::schema();
        $properties->clientCredentials = ClientCredentialsFlow::schema();
        $properties->authorizationCode = AuthorizationCodeOAuthFlow::schema();
        $ownerSchema->type = Schema::OBJECT;
        $ownerSchema->additionalProperties = false;
        $x = new Schema();
        $ownerSchema->setPatternProperty('^x-', $x);
        $ownerSchema->setFromRef('#/definitions/OAuthFlows');
    }

    /**
     * @param ImplicitOAuthFlow $implicit
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setImplicit(ImplicitOAuthFlow $implicit)
    {
        $this->implicit = $implicit;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param PasswordOAuthFlow $password
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setPassword(PasswordOAuthFlow $password)
    {
        $this->password = $password;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param ClientCredentialsFlow $clientCredentials
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setClientCredentials(ClientCredentialsFlow $clientCredentials)
    {
        $this->clientCredentials = $clientCredentials;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */

    /**
     * @param AuthorizationCodeOAuthFlow $authorizationCode
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setAuthorizationCode(AuthorizationCodeOAuthFlow $authorizationCode)
    {
        $this->authorizationCode = $authorizationCode;
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