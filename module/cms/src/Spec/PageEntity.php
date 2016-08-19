<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\CMS\Spec;

use Doctrine\Common\Collections\Collection;

interface PageEntity
{

    const STATUS_VISIBLE = 1;
    const STATUS_HIDDEN = 0;

    /**
     * Object constructor
     *
     * @return PageEntity
     */
    public function __construct();

    /**
     * @param Collection|PageI18nEntity[] $translations
     *
     * @return PageEntity
     */
    public function addTranslations(Collection $translations
    ): PageEntity;

    /**
     * @param PageI18nEntity $translation
     *
     * @return PageEntity
     */
    public function addTranslation(PageI18nEntity $translation
    ): PageEntity;

    /**
     * @param Collection|PageI18nEntity[] $translations
     *
     * @return PageEntity
     */
    public function removeTranslations(Collection $translations
    ): PageEntity;

    /**
     * @param PageI18nEntity $translation
     *
     * @return PageEntity
     */
    public function removeTranslation(PageI18nEntity $translation
    ): PageEntity;

    /**
     * @return bool
     */
    public function isVisible(): bool;

    /**
     * @return int
     */
    public function getStatus(): int;

    /**
     * @return bool
     */
    public function isHidden(): bool;

    /**
     * Perform a deep clone
     *
     * @return PageEntity
     */
    public function __clone();

    /**
     * @return Collection|PageI18nEntity[]
     */
    public function getTranslations(): Collection;

    /**
     * @param Collection|PageI18nEntity[] $translations
     *
     * @return PageEntity
     */
    public function setTranslations(Collection $translations
    ): PageEntity;

    /**
     * @return \DateTimeInterface
     */
    public function getCreatedAt(): \DateTimeInterface;

    /**
     * @param \DateTimeInterface $createdAt
     *
     * @return PageEntity
     */
    public function setCreatedAt(\DateTimeInterface $createdAt);

    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     *
     * @return PageEntity
     */
    public function setId($id): PageEntity;

    /**
     * @return \DateTimeInterface
     */
    public function getUpdatedAt();

    /**
     * @param \DateTimeInterface $updatedAt
     *
     * @return PageEntity
     */
    public function setUpdatedAt(\DateTimeInterface $updatedAt = null);

    /**
     * @return string
     */
    public function getUrlKey();

    /**
     * @param int $status
     *
     * @return PageEntity
     */
    public function setStatus($status): PageEntity;

    /**
     * @param string $urlKey
     *
     * @return PageEntity
     */
    public function setUrlKey($urlKey);
}
