<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\RestApi\Entity\OAuth2;

use Doctrine\Common\Collections\ArrayCollection;
use WellCart\ORM\AbstractEntity;
use WellCart\ORM\Entity;
use WellCart\ORM\EntityTrait;
use ZF\OAuth2\Doctrine\Entity\UserInterface;

class Client extends AbstractEntity implements Entity
{
    use EntityTrait;

    /**
     * @var string
     */
    protected $clientId;

    /**
     * @var string
     */
    protected $secret;

    /**
     * @var string
     */
    protected $redirectUri;

    /**
     * @var array
     */
    protected $grantType
        = [
            'authorization_code',
            'client_credentials',
            'refresh_token',
            'implicit',
            'urn:ietf:params:oauth:grant-type:jwt-bearer',
        ];

    /**
     * @var string
     */
    protected $clientScope;

    /**
     * @var integer
     */
    protected $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $accessToken;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $refreshToken;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $authorizationCode;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $jwt;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $jti;

    /**
     * @var \ZF\OAuth2\Doctrine\Entity\PublicKey
     */
    protected $publicKey;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $scope;

    /**
     * UserInterface
     *
     * @var User
     */
    protected $user;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->accessToken = new ArrayCollection();
        $this->refreshToken = new ArrayCollection();
        $this->authorizationCode = new ArrayCollection();
        $this->jwt = new ArrayCollection();
        $this->jti = new ArrayCollection();
        $this->scope = new ArrayCollection();
    }

    public function getArrayCopy()
    {
        return [
            'id'          => $this->getId(),
            'clientId'    => $this->getClientId(),
            'secret'      => $this->getSecret(),
            'redirectUri' => $this->getRedirectUri(),
            'grantType'   => $this->getGrantType(),
            'scope'       => $this->getScope(),
            'user'        => $this->getUser(),
        ];
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritDoc
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get clientId
     *
     * @return string
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * Set clientId
     *
     * @param string $clientId
     *
     * @return Client
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;

        return $this;
    }

    /**
     * Get secret
     *
     * @return string
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * Set secret
     *
     * @param string $secret
     *
     * @return Client
     */
    public function setSecret($secret)
    {
        $this->secret = $secret;

        return $this;
    }

    /**
     * Get redirectUri
     *
     * @return string
     */
    public function getRedirectUri()
    {
        return $this->redirectUri;
    }

    /**
     * Set redirectUri
     *
     * @param string $redirectUri
     *
     * @return Client
     */
    public function setRedirectUri($redirectUri)
    {
        $this->redirectUri = $redirectUri;

        return $this;
    }

    /**
     * Get grantType
     *
     * @return array
     */
    public function getGrantType()
    {
        return $this->grantType;
    }

    /**
     * Set grantType
     *
     * @param array $grantType
     *
     * @return Client
     */
    public function setGrantType($grantType)
    {
        $this->grantType = $grantType;

        return $this;
    }

    /**
     * Get scope
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getScope()
    {
        return $this->scope;
    }

    /**
     * Get user
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set user
     *
     * @param $user
     *
     * @return Client
     */
    public function setUser(UserInterface $user = null)
    {
        $this->user = $user;

        return $this;
    }

    public function exchangeArray(array $array)
    {
        foreach ($array as $key => $value) {
            switch ($key) {
                case 'clientId':
                    $this->setClientId($value);
                    break;
                case 'secret':
                    $this->setSecret($value);
                    break;
                case 'redirectUri':
                    $this->setRedirectUri($value);
                    break;
                case 'grantType':
                    $this->setGrantType($value);
                    break;
                case 'user':
                    $this->setUser($value);
                    break;
                case 'scope':
                    // Clear old collection
                    foreach ($value as $remove) {
                        $this->removeScope($remove);
                        $remove->removeClient($this);
                    }

                    // Add new collection
                    foreach ($value as $scope) {
                        $this->addScope($scope);
                        $scope->removeClient($this);
                    }
                    break;
                default:
                    break;
            }
        }

        return $this;
    }

    /**
     * Remove scope
     *
     * @param Scope $scope
     */
    public function removeScope(Scope $scope)
    {
        $this->scope->removeElement($scope);
    }

    /**
     * Add scope
     *
     * @param Scope $scope
     *
     * @return Client
     */
    public function addScope(Scope $scope)
    {
        $this->scope[] = $scope;

        return $this;
    }

    /**
     * Get clientScope
     *
     * @return string
     */
    public function getClientgetScope()
    {
        return $this->clientScope;
    }

    /**
     * Set clientScope
     *
     * @param string $clientScope
     *
     * @return Client
     */
    public function setClientScope($clientScope)
    {
        $this->clientScope = $clientScope;

        return $this;
    }

    /**
     * Add accessToken
     *
     * @param AccessToken $accessToken
     *
     * @return Client
     */
    public function addAccessToken(AccessToken $accessToken)
    {
        $this->accessToken[] = $accessToken;

        return $this;
    }

    /**
     * Remove accessToken
     *
     * @param AccessToken $accessToken
     */
    public function removeAccessToken(AccessToken $accessToken)
    {
        $this->accessToken->removeElement($accessToken);
    }

    /**
     * Get accessToken
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * Add refreshToken
     *
     * @param RefreshToken $refreshToken
     *
     * @return Client
     */
    public function addRefreshToken(RefreshToken $refreshToken)
    {
        $this->refreshToken[] = $refreshToken;

        return $this;
    }

    /**
     * Remove refreshToken
     *
     * @param RefreshToken $refreshToken
     */
    public function removeRefreshToken(RefreshToken $refreshToken)
    {
        $this->refreshToken->removeElement($refreshToken);
    }

    /**
     * Get refreshToken
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRefreshToken()
    {
        return $this->refreshToken;
    }

    /**
     * Add authorizationCode
     *
     * @param AuthorizationCode $authorizationCode
     *
     * @return Client
     */
    public function addAuthorizationCode(AuthorizationCode $authorizationCode)
    {
        $this->authorizationCode[] = $authorizationCode;

        return $this;
    }

    /**
     * Remove authorizationCode
     *
     * @param AuthorizationCode $authorizationCode
     */
    public function removeAuthorizationCode(AuthorizationCode $authorizationCode
    ) {
        $this->authorizationCode->removeElement($authorizationCode);
    }

    /**
     * Get authorizationCode
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAuthorizationCode()
    {
        return $this->authorizationCode;
    }

    /**
     * Add jwt
     *
     * @param Jwt $jwt
     *
     * @return Client
     */
    public function addJwt(Jwt $jwt)
    {
        $this->jwt[] = $jwt;

        return $this;
    }

    /**
     * Remove jwt
     *
     * @param Jwt $jwt
     */
    public function removeJwt(Jwt $jwt)
    {
        $this->jwt->removeElement($jwt);
    }

    /**
     * Get jwt
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getJwt()
    {
        return $this->jwt;
    }

    /**
     * Add jti
     *
     * @param Jti $jti
     *
     * @return Client
     */
    public function addJti(Jti $jti)
    {
        $this->jti[] = $jti;

        return $this;
    }

    /**
     * Remove jti
     *
     * @param Jti $jti
     */
    public function removeJti(Jti $jti)
    {
        $this->jti->removeElement($jti);
    }

    /**
     * Get jti
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getJti()
    {
        return $this->jti;
    }

    /**
     * Get publicKey
     *
     * @return PublicKey
     */
    public function getPublicKey()
    {
        return $this->publicKey;
    }

    /**
     * Set publicKey
     */
    public function setPublicKey(PublicKey $value)
    {
        $this->publicKey = $value;

        return $this;
    }
}
