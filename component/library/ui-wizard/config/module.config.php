<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

return [
    'wizard' => [
        'default_layout_template' => 'wizard/layout',
    ],

    'service_manager' => [
        'invokables' => [
            'WellCart\Ui\Wizard\Form\FormFactory'                => 'WellCart\Ui\Wizard\Form\FormFactory',
            'WellCart\Ui\Wizard\Listener\StepCollectionListener' => 'WellCart\Ui\Wizard\Listener\StepCollectionListener',
            'WellCart\Ui\Wizard\Listener\WizardListener'         => 'WellCart\Ui\Wizard\Listener\WizardListener',
        ],
        'factories' => [
            'WellCart\Ui\Wizard\Config'                    => 'WellCart\Ui\Wizard\Factory\ConfigFactory',
            'WellCart\Ui\Wizard\Step\StepFactory'          => 'WellCart\Ui\Wizard\Factory\StepFactoryFactory',
            'WellCart\Ui\Wizard\WizardFactory'             => 'WellCart\Ui\Wizard\Factory\WizardFactoryFactory',
            'WellCart\Ui\Wizard\Listener\DispatchListener' => 'WellCart\Ui\Wizard\Factory\DispatchListenerFactory',
            'WellCart\Ui\Wizard\Wizard'                    => 'WellCart\Ui\Wizard\Factory\WizardFactory',
            'WellCart\Ui\Wizard\WizardProcessor'           => 'WellCart\Ui\Wizard\Factory\WizardProcessorFactory',
            'WellCart\Ui\Wizard\WizardRenderer'            => 'WellCart\Ui\Wizard\Factory\WizardRendererFactory',
            'WellCart\Ui\Wizard\WizardResolver'            => 'WellCart\Ui\Wizard\Factory\WizardResolverFactory',
            'WellCart\Ui\Wizard\Wizard\IdentifierAccessor' => 'WellCart\Ui\Wizard\Factory\IdentifierAccessorFactory',
            'WellCart\Ui\Wizard\Step\StepPluginManager'    => 'WellCart\Ui\Wizard\Factory\StepPluginManagerFactory',
        ],
        'shared' => [
            'WellCart\Ui\Wizard\Wizard' => false,
        ],
    ],

    'form_elements' => [
        'invokables' => [
            'WellCart\Ui\Wizard\Form\Element\Button\Cancel'   => 'WellCart\Ui\Wizard\Form\Element\Button\Cancel',
            'WellCart\Ui\Wizard\Form\Element\Button\Next'     => 'WellCart\Ui\Wizard\Form\Element\Button\Next',
            'WellCart\Ui\Wizard\Form\Element\Button\Previous' => 'WellCart\Ui\Wizard\Form\Element\Button\Previous',
            'WellCart\Ui\Wizard\Form\Element\Button\Valid'    => 'WellCart\Ui\Wizard\Form\Element\Button\Valid',
        ],
    ],

    'view_manager' => [
        'template_map' => [
            'wizard/layout'  => __DIR__ . '/../view/wizard/layout.phtml',
            'wizard/header'  => __DIR__ . '/../view/wizard/header.phtml',
            'wizard/buttons' => __DIR__ . '/../view/wizard/buttons.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
