<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Form;

use WellCart\Catalog\Exception;
use WellCart\Catalog\Spec\CategoryEntity;
use WellCart\Catalog\Spec\CategoryI18nEntity;
use WellCart\Form\Form as AbstractForm;
use WellCart\Hydrator\DoctrineObject as ObjectHydrator;
use Zend\Form\Factory;
use Zend\Form\FormInterface;

class Category extends AbstractForm
{

    /**
     * Form constructor
     *
     * @param Factory        $factory
     * @param ObjectHydrator $hydrator
     */
    public function __construct(
        Factory $factory,
        ObjectHydrator $hydrator,
        CategoryEntity $categoryPrototype,
        CategoryI18nEntity $categoryTranslationPrototype
    ) {
        $this->setFormFactory($factory);
        parent::__construct('catalog_category');

        $this->setWrapElements(true);

        $this->setHydrator($hydrator);

        $categoryFieldset = new Category\CategoryFieldset(
            $factory,
            $hydrator,
            $categoryPrototype,
            $categoryTranslationPrototype
        );

        $categoryFieldset->setUseAsBaseFieldset(true);
        $this->add($categoryFieldset, ['priority' => 700]);

        $this->addToolbarButton(
            [
                'name'       => 'save',
                'type'       => 'Submit',
                'options'    => [
                    'label'       => __('Save')
                ],
            ]
        );

        $saveAndContinue = clone $this->get('save');
        $saveAndContinue
            ->setName('save_and_continue_edit')
            ->setLabel(__('Save & Continue Edit'));
        $this->addToolbarButton($saveAndContinue, 120000);

        $this->setValidationGroup(
            [
                'category' => [
                    'is_visible',
                    'url_key',
                    'parent',
                    'translations' => [
                        'language',
                        'name',
                        'description',
                        'meta_title',
                        'meta_keywords',
                        'meta_description',
                    ],
                ],
            ]
        );

        $this->getEventManager()->trigger('init', $this);
    }

    /**
     * @inheritdoc
     */
    public function bind($object, $flags = FormInterface::VALUES_NORMALIZED)
    {
        if (!$object instanceof CategoryEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\Catalog\Spec\CategoryEntity'
            );
        }
        return parent::bind($object, $flags);
    }

    /**
     * @inheritdoc
     */
    public function setObject($object)
    {
        if (!$object instanceof CategoryEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\Catalog\Spec\CategoryEntity'
            );
        }
        return parent::setObject($object);
    }
}
