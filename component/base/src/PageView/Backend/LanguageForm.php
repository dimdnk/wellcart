<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Base\PageView\Backend;

use WellCart\Backend\PageView\Form\Standard;
use WellCart\Base\Exception;
use WellCart\Base\Spec\LocaleLanguageEntity;
use WellCart\Base\Spec\LocaleLanguageRepository;
use WellCart\ORM\Entity;

class LanguageForm extends Standard
{

    public function __construct(
        LocaleLanguageRepository $repository,
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

        $this->addLayoutHandle('base/languages/form');
        $this->setPageTitle(__('Languages'))
            ->setBreadcrumbs(
                [
                    'list' => [
                        'label'  => __('Languages'),
                        'route'  => 'backend/base/languages',
                        'params' => [],
                    ],
                ]
            );

        $entity = $this->getEntity();
        if ($entity->getId() > 0) {
            $this->addLayoutHandle('base/languages/form/update');
            $this->setFormTitle(
                sprintf(
                    __('Edit language settings: %s'),
                    e($entity->getName())
                )
            );
        } else {
            $this->addLayoutHandle('base/languages/form/create');
            $this->setFormTitle(
                sprintf(
                    __('Create language settings %s'),
                    e($entity->getName())
                )
            );
        }

        return parent::prepare($template, $values);
    }

    /**
     * @inheritdoc
     */
    public function setEntity(Entity $entity)
    {
        if (!$entity instanceof LocaleLanguageEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\Base\Spec\LocaleLanguageEntity'
            );
        }

        return parent::setEntity($entity);
    }
}
