<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\CMS\Form;

use WellCart\CMS\Exception;
use WellCart\CMS\Spec\PageI18nEntity;
use WellCart\Form\Fieldset;
use WellCart\Hydrator\DoctrineObject as ObjectHydrator;
use Zend\Form\Factory;

class PageI18nFieldset extends Fieldset
{

    public function __construct(
        Factory $factory,
        ObjectHydrator $hydrator,
        PageI18nEntity $pageTranslationPrototype
    ) {
        $this->setFormFactory($factory);
        parent::__construct('translations');
        $this->setHydrator($hydrator)
            ->setObject($pageTranslationPrototype);

        $this->setAttribute('class', 'page-translation-fieldset');

        $this->add(
            [
                'name' => 'page_id',
                'type' => 'hidden',
            ],
            ['priority' => 700]
        );

        $this->add(
            [
                'name' => 'language',
                'type' => 'hidden',
            ],
            ['priority' => 700]
        );


        $this->add(
            [
                'name'    => 'title',
                'type'    => 'Text',
                'options' => [
                    'label' => __('Title'),
                ],
            ],
            ['priority' => 700]
        );

        $this->add(
            [
                'name'       => 'body',
                'type'       => 'Textarea',
                'options'    => [
                    'label' => __('Content'),
                ],
                'attributes' => [
                    'class' => 'wysiwyg-tinymce',
                ],
            ],
            ['priority' => 650]
        );

        $this->add(
            [
                'name'    => 'meta_title',
                'type'    => 'Text',
                'options' => [
                    'label' => __('Page Title'),
                ],
            ],
            ['priority' => 600]
        );

        $this->add(
            [
                'name'    => 'meta_keywords',
                'type'    => 'Textarea',
                'options' => [
                    'label' => __('Meta Keywords'),
                ],
            ],
            ['priority' => 550]
        );

        $this->add(
            [
                'name'    => 'meta_description',
                'type'    => 'Textarea',
                'options' => [
                    'label'      => __('Meta Description'),
                    'help-block' => __('Maximum 255 chars'),

                ],
            ],
            ['priority' => 500]
        );
    }

    /**
     * @inheritdoc
     */
    public function setObject($object)
    {
        if (!$object instanceof PageI18nEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\CMS\Spec\PageI18nEntity'
            );
        }

        return parent::setObject($object);
    }
}
