<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Ui\Wizard\Form;

use Zend\Form\Form;
use Zend\Form\FormInterface;
use Zend\ServiceManager\ServiceManager;
use Zend\ServiceManager\ServiceManagerAwareInterface;

class FormFactory implements ServiceManagerAwareInterface
{
    /**
     * @var ServiceManager
     */
    protected $serviceManager;

    /**
     * @param ServiceManager $serviceManager
     */
    public function setServiceManager(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
    }

    /**
     * @param  ServiceLocatorInterface $serviceLocator
     * @return FormInterface
     */
    public function create()
    {
        $formElementManager = $this->serviceManager->get('FormElementManager');

        $form = new Form();
        $form
            ->add($formElementManager->get('WellCart\Ui\Wizard\Form\Element\Button\Previous'))
            ->add($formElementManager->get('WellCart\Ui\Wizard\Form\Element\Button\Next'))
            ->add($formElementManager->get('WellCart\Ui\Wizard\Form\Element\Button\Valid'))
            ->add($formElementManager->get('WellCart\Ui\Wizard\Form\Element\Button\Cancel'));

        return $form;
    }
}