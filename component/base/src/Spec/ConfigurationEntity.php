<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Base\Spec;

interface ConfigurationEntity
{

    /**
     * Object constructor
     *
     */
    public function __construct();

    /**
     * Config key
     *
     * @return string
     */
    public function getConfigKey(): string;

    /**
     * @param string $configKey
     *
     * @return ConfigurationEntity
     */
    public function setConfigKey(string $configKey
    ): ConfigurationEntity;

    /**
     * @return string
     */
    public function getConfigValue();

    /**
     * @param string $configValue
     *
     * @return ConfigurationEntity
     */
    public function setConfigValue($configValue): ConfigurationEntity;

    /**
     * @return \DateTimeInterface
     */
    public function getCreatedAt(): \DateTimeInterface;

    /**
     * @param \DateTimeInterface $createdAt
     *
     * @return ConfigurationEntity
     */
    public function setCreatedAt(\DateTimeInterface $createdAt
    ): ConfigurationEntity;

    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     *
     * @return ConfigurationEntity
     */
    public function setId($id): ConfigurationEntity;

    /**
     * @return \DateTimeInterface
     */
    public function getUpdatedAt();

    /**
     * @param \DateTimeInterface $updatedAt
     *
     * @return ConfigurationEntity
     */
    public function setUpdatedAt(\DateTimeInterface $updatedAt = null
    ): ConfigurationEntity;
}
