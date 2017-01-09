<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Base\Form;

use WellCart\Base\Exception;
use WellCart\Base\Spec\UrlRewriteEntity;
use WellCart\Form\Form as AbstractForm;
use WellCart\Hydrator\DoctrineObject as ObjectHydrator;
use Zend\Form\Factory;
use Zend\Form\FormInterface;

class UrlRewrite extends AbstractForm
{

    /**
     * Form constructor
     *
     * @param Factory        $factory
     * @param ObjectHydrator $hydrator
     */
    public function __construct(
        Factory $factory,
        ObjectHydrator $hydrator
    ) {
        $this->setFormFactory($factory);
        parent::__construct('base_url_rewrite');
        $this->setWrapElements(true);

        $this->setHydrator($hydrator);

        $this->add(
            [
                'name'       => 'request_path',
                'type'       => 'Text',
                'options'    => [
                    'label'            => __('Request Path'),
                ],
                'attributes' => [
                    'id'       => 'base_url_rewrite_request_path',
                    'required' => 'required'
                ],
            ],
            ['priority' => 700]
        );


        $this->add(
            [
                'name'       => 'target_path',
                'type'       => 'Text',
                'options'    => [
                    'label'            => __('Target Path'),
                ],
                'attributes' => [
                    'id'       => 'base_url_rewrite_target_path',
                    'required' => 'required'
                ],
            ],
            ['priority' => 650]
        );

        $this->add(
            [
                'type'       => 'Csrf',
                'name'       => 'csrf',
                'attributes' => [
                    'id' => 'base_url_rewrite_csrf',
                ],
            ],
            ['priority' => 100000]
        );

        $this->addToolbarButton(
            [
                'name'       => 'save',
                'type'       => 'Submit',
                'options'    => [
                    'label'       => __('Save'),
                ],
            ]
        );

        $saveAndContinue = clone $this->get('save');
        $saveAndContinue
            ->setName('save_and_continue_edit')
            ->setLabel(__('Save & Continue Edit'));
        $this->addToolbarButton($saveAndContinue, 120000);

        $this->getEventManager()->trigger('init', $this);
    }

    /**
     * @inheritdoc
     */
    public function bind($object, $flags = FormInterface::VALUES_NORMALIZED)
    {
        if (!$object instanceof UrlRewriteEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\Base\Spec\UrlRewriteEntity'
            );
        }
        return parent::bind($object, $flags);
    }

    /**
     * @inheritdoc
     */
    public function setObject($object)
    {
        if (!$object instanceof UrlRewriteEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\Base\Spec\UrlRewriteEntity'
            );
        }
        return parent::setObject($object);
    }
}
