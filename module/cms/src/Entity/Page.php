<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\CMS\Entity;

use Doctrine\Common\Collections\Collection;
use WellCart\CMS\Spec\PageEntity;
use WellCart\CMS\Spec\PageI18nEntity;
use WellCart\ORM\AbstractEntity;
use WellCart\ORM\TranslatableEntity;
use WellCart\Stdlib\Collection\ArrayCollection;
use WellCart\Utility\Time;

class Page extends AbstractEntity implements TranslatableEntity, PageEntity
{

    /**
     * ID
     *
     * @var int
     */
    protected $id;

    /**
     * @var int
     */
    protected $status = PageEntity::STATUS_VISIBLE;

    /**
     * @var Collection|PageI18nEntity[]
     */
    protected $translations;

    /**
     * @var string
     */
    protected $urlKey;

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
     * @param Collection|PageI18nEntity[] $translations
     *
     * @return PageEntity
     */
    public function addTranslations(Collection $translations
    ): PageEntity
    {
        foreach ($translations as $translation) {
            if ($this->translations->contains($translation)) {
                continue;
            }

            $translation->setPage($this);
            $this->translations->add($translation);
        }
        return $this;
    }

    /**
     * @param PageI18nEntity $translation
     *
     * @return PageEntity
     */
    public function addTranslation(PageI18nEntity $translation
    ): PageEntity
    {
        if ($this->translations->contains($translation)) {
            return $this;
        }

        $translation->setPage($this);
        $this->translations->add($translation);
        return $this;
    }

    /**
     * @param Collection|PageI18nEntity[] $translations
     *
     * @return PageEntity
     */
    public function removeTranslations(Collection $translations
    ): PageEntity
    {
        foreach ($translations as $translation) {
            $this->removeTranslation($translation);
        }
        return $this;
    }

    /**
     * @param PageI18nEntity $translation
     *
     * @return PageEntity
     */
    public function removeTranslation(PageI18nEntity $translation
    ): PageEntity
    {
        $translation->setPage(null);
        $this->translations->removeElement($translation);
        return $this;
    }

    /**
     * @return bool
     */
    public function isVisible(): bool
    {
        return ($this->getStatus() == PageEntity::STATUS_VISIBLE);
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     *
     * @return PageEntity
     */
    public function setStatus($status): PageEntity
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return bool
     */
    public function isHidden(): bool
    {
        return ($this->getStatus() == PageEntity::STATUS_HIDDEN);
    }

    /**
     * Perform a deep clone
     *
     * @return PageEntity
     */
    public function __clone()
    {
        $this->__construct();
    }

    /**
     * Object constructor
     *
     */
    public function __construct()
    {
        $this->setCreatedAt(new Time());
        $this->translations = new ArrayCollection();
    }

    /**
     * @return Collection|PageI18nEntity[]
     */
    public function getTranslations(): Collection
    {
        return $this->translations;
    }

    /**
     * @param Collection|PageI18nEntity[] $translations
     *
     * @return PageEntity
     */
    public function setTranslations(Collection $translations
    ): PageEntity
    {
        $this->translations = $translations;
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
     * @return PageEntity
     */
    public function setCreatedAt(\DateTimeInterface $createdAt
    ): PageEntity
    {
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
     * @return PageEntity
     */
    public function setId($id): PageEntity
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
     * @return PageEntity
     */
    public function setUpdatedAt(\DateTimeInterface $updatedAt = null)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrlKey()
    {
        return $this->urlKey;
    }

    /**
     * @param string $urlKey
     *
     * @return PageEntity
     */
    public function setUrlKey($urlKey): PageEntity
    {
        $this->urlKey = $urlKey;
        return $this;
    }
}
