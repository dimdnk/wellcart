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

interface AttributeI18nEntity
{

    /**
     * Object constructor
     *
     */
    public function __construct();


    /**
     * @return AttributeEntity
     */
    public function getAttribute();

    /**
     * @param AttributeEntity|null $option
     *
     * @return AttributeI18nEntity
     */
    public function setAttribute(AttributeEntity $option = null);

    /**
     * @return \WellCart\Base\Spec\LocaleLanguageEntity
     */
    public function getLanguage() :?LocaleLanguageEntity;

    /**
     * @param LocaleLanguageEntity|null $language
     *
     * @return AttributeI18nEntity
     */
    public function setLanguage(?LocaleLanguageEntity $language);

    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     *
     * @return AttributeI18nEntity
     */
    public function setId($id): AttributeI18nEntity;

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     *
     * @return AttributeI18nEntity
     */
    public function setName($name);

    public function getAttributeId();

    /**
     * @param int $optionId
     *
     * @return AttributeI18nEntity
     */
    public function setAttributeId($optionId): AttributeI18nEntity;
}
