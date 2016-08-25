<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Setup\Wizard\Step;

use WellCart\Form\Form;
use WellCart\Utility\Config;
use Zend\InputFilter\InputFilterProviderInterface;

class DbConfigurationForm extends Form implements InputFilterProviderInterface
{

    /**
     * @param null $name
     */
    public function __construct($name = null)
    {
        parent::__construct($name);

        if (extension_loaded('pdo_pgsql')) {
            $this->add(
                [
                    'name'       => 'driver',
                    'type'       => 'Select',
                    'options'    => [
                        'label'         => __('Driver'),
                        'value_options' => [
                            'pdo_mysql' => __('MySQL'),
                            'pdo_pgsql' => __('PostgreSQL'),
                        ],
                    ],
                    'attributes' => ['class' => 'chosen-element',],
                ],
                ['priority' => 750]
            );
        }

        $this->add(
            [
                'name'       => 'host',
                'type'       => 'Text',
                'options'    => [
                    'label' => __('Server'),
                ],
                'attributes' => [
                    'autocomplete'   => 'off',
                    'value'          => 'localhost',
                    'data-toggle'    => 'tooltip',
                    'data-placement' => 'right',
                    'data-container' => 'body',
                    'title'          => __(
                        "Name and location of the server that hosts your store's database."
                    ),
                ],
            ],
            ['priority' => 700]
        );

        $this->add(
            [
                'name'       => 'username',
                'type'       => 'Text',
                'options'    => [
                    'label' => __('Username'),
                ],
                'attributes' => [
                    'autocomplete'   => 'off',
                    'value'          => 'root',
                    'data-toggle'    => 'tooltip',
                    'data-placement' => 'right',
                    'data-container' => 'body',
                    'title'          => __(
                        "Sign-in credentials for your store's database on the database server (does not need to be admin-level credentials)."
                    ),
                ],
            ],
            ['priority' => 650]
        );
        $this->add(
            [
                'name'       => 'password',
                'type'       => 'password',
                'options'    => [
                    'label' => __('Password'),
                ],
                'attributes' => [
                    'autocomplete'   => 'off',
                    'placeholder'    => __('(not always necessary)'),
                    'data-toggle'    => 'tooltip',
                    'data-placement' => 'right',
                    'data-container' => 'body',
                    'title'          => __(
                        "Sign-in credentials for your store's database on the database server (does not need to be admin-level credentials)."
                    ),
                ],
            ],
            ['priority' => 600]
        );
        $this->add(
            [
                'name'       => 'port',
                'type'       => 'Text',
                'options'    => [
                    'label' => __('Port'),
                ],
                'attributes' => [
                    'autocomplete'   => 'off',
                    'value'          => 3306,
                    'data-toggle'    => 'tooltip',
                    'data-placement' => 'right',
                    'data-container' => 'body',
                    'title'          => __("The default port is 3306."),
                ],
            ],
            ['priority' => 550]
        );

        $this->add(
            [
                'name'       => 'database',
                'type'       => 'Text',
                'options'    => [
                    'label' => __('Database'),
                ],
                'attributes' => [
                    'autocomplete'   => 'off',
                    'data-toggle'    => 'tooltip',
                    'data-placement' => 'right',
                    'data-container' => 'body',
                    'title'          => __(
                        __("Enter the name of your store's database.")
                    ),
                ],
            ],
            ['priority' => 500]
        );


        $this->add(
            [
                'name'       => 'website_name',
                'type'       => 'Text',
                'options'    => [
                    'label' => __('Website Name'),
                ],
                'attributes' => [
                    'autocomplete' => 'off',
                    'value'        => Config::get('wellcart.website.name'),
                ],
            ],
            ['priority' => 450]
        );

        $this->add(
            [
                'name'       => 'base_path',
                'type'       => 'Text',
                'options'    => [
                    'label'      => __('Website URL'),
                    'help-block' => __(
                        "Fully qualified URLs that end with '/' (slash) e.g. http://example.com/"
                    ),
                ],
                'attributes' => [
                    'autocomplete' => 'off',
                    'value'        => url_to_route(
                        'wellcart:setup:install',
                        [],
                        ['force_canonical' => true]
                    ),
                ],
            ],
            ['priority' => 450]
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
            'username'     =>
                [
                    'name'       => 'username',
                    'required'   => true,
                    'filters'    => [
                        'StripTags'     => ['name' => 'StripTags'],
                        'StringTrim'    => ['name' => 'StringTrim'],
                        'StripNewlines' => ['name' => 'StripNewlines'],
                        'Null'          => ['name' => 'Null'],
                    ],
                    'validators' => [
                        'NotEmpty'     => [
                            'name' => 'NotEmpty',
                        ],
                        'StringLength' => [
                            'name'    => 'StringLength',
                            'options' => [
                                'encoding' => 'UTF-8',
                                'min'      => 1,
                                'max'      => 500,
                            ],
                        ],
                    ],
                ],
            'password'     =>
                [
                    'name'       => 'password',
                    'required'   => false,
                    'filters'    => [
                        'StringTrim' => ['name' => 'StringTrim'],
                    ],
                    'validators' => [
                        'StringLength' => [
                            'name'    => 'StringLength',
                            'options' => [
                                'encoding' => 'UTF-8',
                                'min'      => 1,
                                'max'      => 500,
                            ],
                        ],
                    ],
                ],
            'port'         =>
                [
                    'name'       => 'port',
                    'required'   => true,
                    'filters'    => [
                        'StringTrim' => ['name' => 'StringTrim'],
                    ],
                    'validators' => [
                        'NotEmpty' => [
                            'name' => 'NotEmpty',
                        ],
                        'Digits'   => [
                            'name' => 'Digits',
                        ],
                        'Between'  => [
                            'name'    => 'Between',
                            'options' => [
                                'min' => 0,
                                'max' => 28000,
                            ],
                        ],
                    ],
                ],
            'database'     =>
                [
                    'name'       => 'database',
                    'required'   => true,
                    'filters'    => [
                        'StripTags'     => ['name' => 'StripTags'],
                        'StringTrim'    => ['name' => 'StringTrim'],
                        'StripNewlines' => ['name' => 'StripNewlines'],
                        'Null'          => ['name' => 'Null'],
                    ],
                    'validators' => [
                        'NotEmpty'     => [
                            'name' => 'NotEmpty',
                        ],
                        'StringLength' => [
                            'name'    => 'StringLength',
                            'options' => [
                                'encoding' => 'UTF-8',
                                'min'      => 1,
                                'max'      => 255,
                            ],
                        ],
                    ],
                ],
            'host'         =>
                [
                    'name'       => 'host',
                    'required'   => true,
                    'filters'    => [
                        'StripTags'     => ['name' => 'StripTags'],
                        'StringTrim'    => ['name' => 'StringTrim'],
                        'StripNewlines' => ['name' => 'StripNewlines'],
                        'Null'          => ['name' => 'Null'],
                    ],
                    'validators' => [
                        'NotEmpty'     => [
                            'name' => 'NotEmpty',
                        ],
                        'StringLength' => [
                            'name'    => 'StringLength',
                            'options' => [
                                'encoding' => 'UTF-8',
                                'min'      => 1,
                                'max'      => 255,
                            ],
                        ],
                    ],
                ],
            'website_name' => [
                'required'   => true,
                'filters'    => [
                    'StripTags'     => ['name' => 'StripTags'],
                    'StringTrim'    => ['name' => 'StringTrim'],
                    'StripNewlines' => ['name' => 'StripNewlines'],
                    'Null'          => ['name' => 'Null'],
                ],
                'validators' => [
                    [
                        'name' => 'NotEmpty',
                    ],
                    [
                        'name'    => 'StringLength',
                        'options' => [
                            'encoding' => 'UTF-8',
                            'min'      => 2,
                            'max'      => 255,
                        ],
                    ],
                ],
            ],
            'base_path'    => [
                'required'   => true,
                'filters'    => [
                    'StripTags'     => ['name' => 'StripTags'],
                    'StringTrim'    => ['name' => 'StringTrim'],
                    'StripNewlines' => ['name' => 'StripNewlines'],
                    'Null'          => ['name' => 'Null'],
                ],
                'validators' => [
                    'NotEmpty'     => [
                        'name' => 'NotEmpty',
                    ],
                    'StringLength' => [
                        'name'    => 'StringLength',
                        'options' => [
                            'encoding' => 'UTF-8',
                            'min'      => 10,
                            'max'      => 255,
                        ],
                    ],
                    'Uri'          => [
                        'name'    => 'Uri',
                        'options' => [
                            'allow_relative' => false,
                        ],
                    ],
                ],
            ],
        ];

        $this->getEventManager()->trigger(
            __FUNCTION__,
            $this,
            ['specification' => &$specification]
        );
        return $specification;
    }
}
