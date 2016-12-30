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

interface ProductTemplateI18nEntity
{

    /**
     * Object constructor
     *
     */
    public function __construct();


    /**
     * @return ProductTemplateEntity
     */
    public function getProductTemplate();

    /**
     * @param ProductTemplateEntity|null $option
     *
     * @return ProductTemplateI18nEntity
     */
    public function setProductTemplate(ProductTemplateEntity $option = null
    );

    /**
     * @return \WellCart\Base\Spec\LocaleLanguageEntity
     */
    public function getLanguage();

    /**
     * @param LocaleLanguageEntity|null $language
     *
     * @return ProductTemplateI18nEntity
     */
    public function setLanguage(LocaleLanguageEntity $language = null);

    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     *
     * @return ProductTemplateI18nEntity
     */
    public function setId($id): ProductTemplateI18nEntity;

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     *
     * @return ProductTemplateI18nEntity
     */
    public function setName($name);

    /**
     * @return int
     */
    public function getProductTemplateId();

    /**
     * @param int $productTemplateId
     *
     * @return ProductTemplateI18nEntity
     */
    public function setProductTemplateId($productTemplateId
    ): ProductTemplateI18nEntity;
}
