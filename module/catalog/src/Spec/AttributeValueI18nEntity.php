<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Spec;

use WellCart\Base\Spec\LocaleLanguageEntity;

interface AttributeValueI18nEntity
{

    /**
     * Object constructor
     *
     */
    public function __construct();


    /**
     * @return AttributeValueEntity
     */
    public function getAttributeValue();

    /**
     * @param AttributeValueEntity|null $option
     *
     * @return AttributeValueI18nEntity
     */
    public function setAttributeValue(AttributeValueEntity $option = null);

    /**
     * @return \WellCart\Base\Spec\LocaleLanguageEntity
     */
    public function getLanguage();

    /**
     * @param LocaleLanguageEntity|null $language
     *
     * @return AttributeValueI18nEntity
     */
    public function setLanguage(LocaleLanguageEntity $language = null);

    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     *
     * @return AttributeValueI18nEntity
     */
    public function setId($id): AttributeValueI18nEntity;

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     *
     * @return AttributeValueI18nEntity
     */
    public function setName($name);

    /**
     * @return AttributeEntity
     */
    public function getAttribute();

    /**
     * @param AttributeEntity $option
     *
     * @return AttributeValueI18nEntity
     */
    public function setAttribute(AttributeEntity $option = null
    ): AttributeValueI18nEntity;
}
