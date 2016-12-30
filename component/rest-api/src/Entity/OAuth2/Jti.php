<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\RestApi\Entity\OAuth2;

use WellCart\ORM\AbstractEntity;
use WellCart\ORM\Entity;
use WellCart\ORM\EntityTrait;

class Jti extends AbstractEntity implements Entity
{
    use EntityTrait;
    /**
     * @var string
     */
    protected $subject;

    /**
     * @var string
     */
    protected $audience;

    /**
     * @var \DateTime
     */
    protected $expires;

    /**
     * @var string
     */
    protected $jti;

    /**
     * @var integer
     */
    protected $id;

    /**
     * @var Client
     */
    protected $client;

    public function exchangeArray(array $array)
    {
        foreach ($array as $key => $value) {
            switch ($key) {
                case 'client':
                    $this->setClient($value);
                    break;
                case 'subject':
                    $this->setSubject($value);
                    break;
                case 'audience':
                    $this->setAudience($value);
                    break;
                case 'expires':
                    $this->setExpires($value);
                    break;
                case 'jti':
                    $this->setJti($value);
                    break;
                default:
                    // @codeCoverageIgnoreStart
                    break;
            }
            // @codeCoverageIgnoreEnd
        }

        return $this;
    }

    public function getArrayCopy()
    {
        return [
            'id'       => $this->getId(),
            'client'   => $this->getClient(),
            'subject'  => $this->getSubject(),
            'audience' => $this->getAudience(),
            'expires'  => $this->getExpires(),
            'jti'      => $this->getJti(),
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
     * Get client
     *
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set client
     *
     * @param Client $client
     *
     * @return Jti
     */
    public function setClient(Client $client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set subject
     *
     * @param string $subject
     *
     * @return Jti
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get audience
     *
     * @return string
     */
    public function getAudience()
    {
        return $this->audience;
    }

    /**
     * Set audience
     *
     * @param string $audience
     *
     * @return Jti
     */
    public function setAudience($audience)
    {
        $this->audience = $audience;

        return $this;
    }

    /**
     * Get expires
     *
     * @return \DateTime
     */
    public function getExpires()
    {
        return $this->expires;
    }

    /**
     * Set expires
     *
     * @param \DateTime $expires
     *
     * @return Jti
     */
    public function setExpires($expires)
    {
        $this->expires = $expires;

        return $this;
    }

    /**
     * Get jti
     *
     * @return string
     */
    public function getJti()
    {
        return $this->jti;
    }

    /**
     * Set jti
     *
     * @param string $jti
     *
     * @return Jti
     */
    public function setJti($jti)
    {
        $this->jti = $jti;

        return $this;
    }
}
