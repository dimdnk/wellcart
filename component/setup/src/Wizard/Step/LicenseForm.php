<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Setup\Wizard\Step;

use WellCart\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;

class LicenseForm extends Form implements InputFilterProviderInterface
{

    /**
     * @param null $name
     */
    public function __construct($name = null)
    {
        parent::__construct($name);
        $this->add(
            [
                'type'       => 'checkbox',
                'name'       => 'agree',
                'options'    => [
                    'label'               => __(
                        'I agree to the above terms and conditions.'
                    ),
                    'strokerform-exclude' => true,
                    'use_hidden_element'  => false,
                    'checked_value'       => 1,
                ],
                'attributes' => [
                    'id'    => 'agree_terms_and_conditions',
                    'class' => 'icheck-element',
                ],
            ],
            ['priority' => 700]
        );

        $this->getEventManager()->trigger('init', $this);
    }

    /**
     * Input filter specification
     *
     * @return array
     */
    public function getInputFilterSpecification()
    {
        $specification = [
            'agree' =>
                [
                    'name'       => 'agree',
                    'required'   => true,
                    'filters'    => [
                        'StripTags'     => ['name' => 'StripTags'],
                        'StringTrim'    => ['name' => 'StringTrim'],
                        'StripNewlines' => ['name' => 'StripNewlines'],
                        'Null'          => ['name' => 'Null'],
                    ],
                    'validators' => [
                        'NotEmpty' => [
                            'name' => 'NotEmpty',
                        ],
                    ],
                ]
        ];

        $this->getEventManager()->trigger(
            __FUNCTION__,
            $this,
            ['specification' => &$specification]
        );
        return $specification;
    }
}
