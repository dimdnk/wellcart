<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\CMS\Entity;

use WellCart\Base\Spec\LocaleLanguageEntity;
use WellCart\CMS\Spec\PageEntity;
use WellCart\CMS\Spec\PageI18nEntity;
use WellCart\ORM\AbstractEntity;
use WellCart\Utility\Time;

class PageI18n extends AbstractEntity implements PageI18nEntity
{

    /**
     * ID
     *
     * @var int
     */
    protected $id;

    /**
     * @var PageEntity
     */
    protected $page;

    /**
     * @var \WellCart\Base\Spec\LocaleLanguageEntity
     */
    protected $language;

    /**
     * Title
     *
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $body;

    /**
     * @var int
     */
    protected $pageId;

    /**
     * @var string
     */
    protected $metaTitle;

    /**
     * @var string
     */
    protected $metaKeywords;

    /**
     * @var string
     */
    protected $metaDescription;

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
     * Object constructor
     *
     */
    public function __construct()
    {
        $this->setCreatedAt(new Time());
    }

    /**
     * @return string
     */
    public function getMetaTitle()
    {
        return $this->metaTitle;
    }

    /**
     * @param string $metaTitle
     *
     * @return PageI18nEntity
     */
    public function setMetaTitle($metaTitle): PageI18nEntity
    {
        $this->metaTitle = $metaTitle;

        return $this;
    }

    /**
     * @return Page
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param PageEntity|null $page
     *
     * @return PageI18nEntity
     */
    public function setPage(PageEntity $page = null
    ): PageI18nEntity {
        $this->page = $page;

        return $this;
    }

    /**
     * @return \WellCart\Base\Spec\LocaleLanguageEntity
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param LocaleLanguageEntity|null $language
     *
     * @return PageI18nEntity
     */
    public function setLanguage(LocaleLanguageEntity $language = null
    ): PageI18nEntity {
        $this->language = $language;

        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTimeInterface $createdAt
     *
     * @return Page
     */
    public function setCreatedAt(\DateTimeInterface $createdAt
    ): PageI18nEntity {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return Page
     */
    public function setId($id): PageI18nEntity
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTimeInterface $updatedAt
     *
     * @return Page
     */
    public function setUpdatedAt(\DateTimeInterface $updatedAt = null
    ): PageI18nEntity {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param string $body
     *
     * @return PageI18nEntity
     */
    public function setBody($body): PageI18nEntity
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @return string
     */
    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

    /**
     * @param string $metaDescription
     *
     * @return PageI18nEntity
     */
    public function setMetaDescription($metaDescription
    ): PageI18nEntity {
        $this->metaDescription = $metaDescription;

        return $this;
    }

    /**
     * @return string
     */
    public function getMetaKeywords()
    {
        return $this->metaKeywords;
    }

    /**
     * @param string $metaKeywords
     *
     * @return PageI18nEntity
     */
    public function setMetaKeywords($metaKeywords
    ): PageI18nEntity {
        $this->metaKeywords = $metaKeywords;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return PageI18nEntity
     */
    public function setTitle($title): PageI18nEntity
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return int
     */
    public function getPageId()
    {
        return $this->pageId;
    }

    /**
     * @param int $pageId
     *
     * @return PageI18nEntity
     */
    public function setPageId($pageId): PageI18nEntity
    {
        $this->pageId = $pageId;

        return $this;
    }
}
