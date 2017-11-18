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
use WellCart\Base\Spec\UrlRewriteEntity;
use WellCart\Base\Spec\UrlRewriteRepository;
use WellCart\ORM\Entity;

class UrlRewriteForm extends Standard
{

    public function __construct(
        UrlRewriteRepository $repository,
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

        $this->addLayoutHandle('base/url-rewrites/form');
        $this->setPageTitle(__('URL Rewrites'))
            ->setBreadcrumbs(
                [
                    'list' => [
                        'label'  => __('URL Rewrites'),
                        'route'  => 'backend/base/url-rewrites',
                        'params' => [],
                    ],
                ]
            );

        $entity = $this->getEntity();
        if ($entity->getId() > 0) {
            $this->addLayoutHandle('base/url-rewrites/form/update');
            $this->setFormTitle(__('Edit URL Rewrite'));
        } else {
            $this->addLayoutHandle('base/url-rewrites/form/create');
            $this->setFormTitle(
                __('Add New URL Rewrite')
            );
        }

        return parent::prepare($template, $values);
    }

    /**
     * @inheritdoc
     */
    public function setEntity(Entity $entity)
    {
        if (!$entity instanceof UrlRewriteEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\Base\Spec\UrlRewriteEntity'
            );
        }

        return parent::setEntity($entity);
    }
}
