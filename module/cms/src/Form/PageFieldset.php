<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\CMS\Form;

use WellCart\CMS\Exception;
use WellCart\CMS\Spec\PageEntity;
use WellCart\CMS\Spec\PageI18nEntity;
use WellCart\Form\Fieldset;
use WellCart\Hydrator\DoctrineObject as ObjectHydrator;
use Zend\Form\Factory;

class PageFieldset extends Fieldset
{

    public function __construct(
        Factory $factory,
        ObjectHydrator $hydrator,
        PageEntity $pagePrototype,
        PageI18nEntity $pageTranslationPrototype
    ) {
        $this->setFormFactory($factory);
        parent::__construct('page');

        $this->setHydrator($hydrator)
            ->setObject($pagePrototype);

        $this->setAttribute('class', 'page-fieldset');

        $this->add(
            [
                'name'       => 'status',
                'type'       => 'checkbox',
                'options'    => [
                    'label'               => __('Online'),
                    'strokerform-exclude' => true,
                    'twb-layout'          => 'horizontal',
                    'column-size'         => 'md-12',
                    'label_attributes'    => [
                        'class' => 'col-md-8 col-md-offset-4',
                    ],
                    'use_hidden_element'  => true,
                    'checked_value'       => 1,
                    'unchecked_value'     => 0,
                ],
                'attributes' => [
                    'id'    => 'cms_page_status',
                    'class' => 'switchery-element',
                    'value' => 1,
                ],
            ],
            ['priority' => 700]
        );
        $this->add(
            [
                'type'       => 'translatableCollection',
                'name'       => 'translations',
                'options'    => [
                    'allow_remove'   => true,
                    'target_element' => new PageI18nFieldset(
                        $factory,
                        $hydrator,
                        $pageTranslationPrototype
                    ),
                ],
                'attributes' => [
                    'class' => 'page-translations',
                ]
            ],
            ['priority' => 650]
        );

        $this->add(
            [
                'name'       => 'url_key',
                'type'       => 'Text',
                'options'    => [
                    'label'            => __('URL Key'),
                    'twb-layout'       => 'horizontal',
                    'column-size'      => 'md-8',
                    'label_attributes' => [
                        'class' => 'col-md-4',
                    ],
                ],
                'attributes' => [
                    'id'               => 'cms_page_url_key',
                    'data-sluggable'   => 'true',
                    'data-slug-source' => '.cms_page_title:first',
                    'required'         => 'required'
                ],
            ],
            ['priority' => 600]
        );
    }

    /**
     * @inheritdoc
     */
    public function setObject($object)
    {
        if (!$object instanceof PageEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\CMS\Spec\PageEntity'
            );
        }
        return parent::setObject($object);
    }
}
