<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\CMS\Spec;

use WellCart\Base\Spec\LocaleLanguageEntity;

interface PageI18nEntity
{

    /**
     * Object constructor
     *
     */
    public function __construct();

    /**
     * @return string
     */
    public function getMetaTitle();

    /**
     * @return PageI18nEntity
     */
    public function getPage();

    /**
     * @param PageEntity|null $page
     *
     * @return PageI18nEntity
     */
    public function setPage(PageEntity $page = null);

    /**
     * @return \WellCart\Base\Spec\LocaleLanguageEntity
     */
    public function getLanguage();

    /**
     * @param LocaleLanguageEntity|null $language
     *
     * @return PageI18nEntity
     */
    public function setLanguage(LocaleLanguageEntity $language = null);

    /**
     * @return \DateTimeInterface
     */
    public function getCreatedAt(): \DateTimeInterface;

    /**
     * @param \DateTimeInterface $createdAt
     *
     * @return PageI18nEntity
     */
    public function setCreatedAt(\DateTimeInterface $createdAt);

    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     *
     * @return PageI18nEntity
     */
    public function setId($id): PageI18nEntity;

    /**
     * @return \DateTimeInterface
     */
    public function getUpdatedAt();

    /**
     * @param \DateTimeInterface $updatedAt
     *
     * @return PageI18nEntity
     */
    public function setUpdatedAt(\DateTimeInterface $updatedAt = null);

    /**
     * @return string
     */
    public function getBody();

    /**
     * @return string
     */
    public function getMetaDescription();

    /**
     * @return string
     */
    public function getMetaKeywords();

    /**
     * @return string
     */
    public function getTitle();

    /**
     * @return int
     */
    public function getPageId();

    /**
     * @param string $title
     *
     * @return PageI18nEntity
     */
    public function setTitle($title);

    /**
     * @param string $body
     *
     * @return PageI18nEntity
     */
    public function setBody($body);

    /**
     * @param int $pageId
     *
     * @return PageI18nEntity
     */
    public function setPageId($pageId);

    /**
     * @param string $metaTitle
     *
     * @return PageI18nEntity
     */
    public function setMetaTitle($metaTitle);

    /**
     * @param string $metaKeywords
     *
     * @return PageI18nEntity
     */
    public function setMetaKeywords($metaKeywords);

    /**
     * @param string $metaDescription
     *
     * @return PageI18nEntity
     */
    public function setMetaDescription($metaDescription);
}
