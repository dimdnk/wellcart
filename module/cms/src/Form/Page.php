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
use WellCart\CMS\Spec\PageEntity;
use WellCart\CMS\Spec\PageI18nEntity;
use WellCart\Ui\Form\LinearForm as AbstractForm;
use WellCart\Hydrator\DoctrineObject as ObjectHydrator;
use Zend\Form\Factory;
use Zend\Form\FormInterface;

class Page extends AbstractForm
{
    /**
     * Canonical form name
     */
    const NAME = 'cms_page';
    /**
     * Form constructor
     *
     * @param Factory        $factory
     * @param ObjectHydrator $hydrator
     * @param PageEntity     $pagePrototype
     * @param PageI18nEntity $pageTranslationPrototype
     */
    public function __construct(
        Factory $factory,
        ObjectHydrator $hydrator,
        PageEntity $pagePrototype,
        PageI18nEntity $pageTranslationPrototype
    ) {
        $this->setFormFactory($factory);
        parent::__construct(static::NAME);

        $this->setWrapElements(true);

        $this->setHydrator($hydrator);

        $pageFieldset = new PageFieldset(
            $factory,
            $hydrator,
            $pagePrototype,
            $pageTranslationPrototype
        );
        $pageFieldset->setUseAsBaseFieldset(true);
        $this->add($pageFieldset, ['priority' => 700]);

        $this->addToolbarAction(
            [
                'name'    => 'save',
                'type'    => 'Submit',
                'options' => [
                    'label' => __('Save'),
                ],
            ]
        );

        $saveAndContinue = clone $this->get('save');
        $saveAndContinue
            ->setName('save_and_continue_edit')
            ->setLabel(__('Save & Continue Edit'));
        $this->addToolbarAction($saveAndContinue, 120000);

        $this->setValidationGroup(
            [
                'page' => [
                    'status',
                    'url_key',
                    'translations' => [
                        'language',
                        'title',
                        'body',
                        'meta_title',
                        'meta_keywords',
                        'meta_description',
                    ],
                ],
                //'csrf',
            ]
        );

        $this->getEventManager()->trigger('init', $this);
    }

    /**
     * @inheritdoc
     */
    public function bind($object, $flags = FormInterface::VALUES_NORMALIZED)
    {
        if (!$object instanceof PageEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\CMS\Spec\PageEntity'
            );
        }

        return parent::bind($object, $flags);
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
