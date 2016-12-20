<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\CMS\PageView\Backend;

use WellCart\Admin\PageView\Form\Standard;
use WellCart\CMS\Exception;
use WellCart\CMS\Spec\PageEntity;
use WellCart\CMS\Spec\PageRepository;
use WellCart\ORM\Entity;

class PageForm extends Standard
{
    public function __construct(
        PageRepository $repository,
        $variables = null,
        $options = null
    ) {
        $this->setRepository($repository);
        parent::__construct($variables, $options);
    }

    /**
     * @inheritdoc
     */
    public function prepare($template = null, $values = null)
    {
        if ($this->isPrepared()) {
            return $this;
        }

        $this->addLayoutHandle('cms/pages/form');
        $this->setPageTitle(__('Pages'))
            ->setBreadcrumbs(
                [
                    'list' => [
                        'label'  => __('Pages'),
                        'route'  => 'zfcadmin/cms/pages',
                        'params' => [],
                    ],
                ]
            );

        $page = $this->getEntity();
        $translations = $page->getTranslations();


        if ($page->getId()) {
            $this->addLayoutHandle('cms/pages/form/update');
            $this->setFormTitle(
                sprintf(
                    __('Edit Page: %s'),
                    e($translations->current()->getTitle())
                )
            );
        } else {
            $this->addLayoutHandle('cms/pages/form/create');
            $this->setFormTitle(__('Create new Page'));
        }
        return parent::prepare($template, $values);
    }

    /**
     * @inheritdoc
     */
    public function setEntity(Entity $entity)
    {
        if (!$entity instanceof PageEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\CMS\Spec\PageEntity'
            );
        }
        return parent::setEntity($entity);
    }
}
