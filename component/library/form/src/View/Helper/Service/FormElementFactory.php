<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);
namespace WellCart\Form\View\Helper\Service;

use Interop\Container\ContainerInterface;
use WellCart\Form\View\Helper\FormElement;
use WellCart\Utility\Config;

class FormElementFactory
{

    /**
     * @param ContainerInterface $pluginManager
     *
     * @return FormElement
     */
    public function __invoke(ContainerInterface $pluginManager)
    {
        $helper = new FormElement(
            $pluginManager->getServiceLocator()->get(
                'TwbBundle\Options\ModuleOptions'
            )
        );

        $classMap = Config::get('form_element_configuration.class_map', []);
        $typeMap = Config::get('form_element_configuration.type_map', []);

        foreach ($classMap as $class => $plugin) {
            $helper->addClass($class, $plugin);
        }

        foreach ($typeMap as $type => $plugin) {
            $helper->addType($type, $plugin);
        }

        return $helper;
    }
}
