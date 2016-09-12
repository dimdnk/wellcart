<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Base\Entity;

use WellCart\Base\Spec\ConfigurationEntity;
use WellCart\ORM\AbstractEntity;
use WellCart\Utility\Time;

class Configuration extends AbstractEntity implements ConfigurationEntity
{

    /**
     * ID
     *
     * @var int
     */
    protected $id;

    /**
     * Config Key
     *
     * @var string
     */
    protected $configKey;

    /**
     * Config Value
     *
     * @var string
     */
    protected $configValue;

    /**
     * Context
     *
     * @var string
     */
    protected $context;

    /**
     * Environment
     *
     * @var string
     */
    protected $environment;

    /**
     * Created at
     *
     * @var \DateTimeInterface
     */
    protected $createdAt;

    /**
     * Updated at
     *
     * @var \DateTimeInterface
     */
    protected $updatedAt;

    /**
     * @inheritdoc
     */
    public function __construct()
    {
        $this->setCreatedAt(new Time());
    }

    /**
     * @inheritdoc
     */
    public function getConfigKey(): string
    {
        return (string)$this->configKey;
    }

    /**
     * @inheritdoc
     */
    public function setConfigKey(string $configKey
    ): ConfigurationEntity
    {
        $this->configKey = $configKey;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getConfigValue(): string
    {
        return (string)$this->configValue;
    }

    /**
     * @inheritdoc
     */
    public function setConfigValue($configValue): ConfigurationEntity
    {
        $this->configValue = $configValue;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @inheritdoc
     */
    public function setCreatedAt(\DateTimeInterface $createdAt
    ): ConfigurationEntity
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function setId($id): ConfigurationEntity
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @inheritdoc
     */
    public function setUpdatedAt(\DateTimeInterface $updatedAt = null
    ): ConfigurationEntity
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return string
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * @param string $context
     *
     * @return : ConfigurationEntity
     */
    public function setContext($context): ConfigurationEntity
    {
        $this->context = $context;
        return $this;
    }

    /**
     * @return string
     */
    public function getEnvironment()
    {
        return $this->environment;
    }

    /**
     * @param string $environment
     *
     * @return ConfigurationEntity
     */
    public function setEnvironment($environment): ConfigurationEntity
    {
        $this->environment = $environment;
        return $this;
    }


}
