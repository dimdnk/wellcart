<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
return [
    'tab' => [
        'general'          => [

            'label'      => 'General Settings',
            'route'      => 'zfcadmin/system-settings/sections',
            'params'     => ['section' => 'general'],
            'permission' => 'admin/system-settings/general/view',
            'fieldset'   => [
                'web_settings' => [
                    'label'    => 'Web Settings',
                    'priority' => -19,
                    'element'  => [


                        'website.name'     =>
                            [
                                'name'                       => 'website.name',
                                'options'                    => [
                                    'label'            => 'Website Name',
                                    'twb-layout'       => 'horizontal',
                                    'column-size'      => 'md-9',
                                    'label_attributes' => [
                                        'class' => 'col-md-3',
                                    ],
                                ],
                                'type'                       => 'text',
                                'input_filter_specification' => [
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
                            ],
                        'router.base_path' =>
                            [
                                'name'                       => 'router.base_path',
                                'options'                    => [
                                    'label'            => 'Base URL',
                                    'twb-layout'       => 'horizontal',
                                    'column-size'      => 'md-9',
                                    'help-block'       => "Fully qualified URLs that end with '/' (slash) e.g. http://example.com/",
                                    'label_attributes' => [
                                        'class' => 'col-md-3',
                                    ],
                                ],
                                'type'                       => 'text',
                                'input_filter_specification' => [
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
                                                'min'      => 10,
                                                'max'      => 255,
                                            ],
                                        ],
                                        [
                                            'name'    => 'Uri',
                                            'options' => [
                                                'allow_relative' => false,
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                    ],
                ],
                'localization' => [
                    'label'    => 'Localization',
                    'priority' => -20,
                    'element'  => [
                        'localization.locale'       =>
                            [
                                'name'                       => 'localization.locale',
                                'options'                    => [
                                    'label'            => 'Locale',
                                    'twb-layout'       => 'horizontal',
                                    'column-size'      => 'md-9',
                                    'label_attributes' => [
                                        'class' => 'col-md-3',
                                    ],
                                ],
                                'attributes'                 => [
                                    'class' => 'chosen-element',
                                ],
                                'type'                       => 'localeSelector',
                                'input_filter_specification' => [
                                    'required'   => true,
                                    'filters'    => [
                                        'StripTags'     => ['name' => 'StripTags'],
                                        'StringTrim'    => ['name' => 'StringTrim'],
                                        'StripNewlines' => ['name' => 'StripNewlines'],
                                        'Null'          => ['name' => 'Null'],
                                    ],
                                    'validators' => [],
                                ],
                            ],
                        'localization.timezone'     =>
                            [
                                'name'                       => 'localization.timezone',
                                'options'                    => [
                                    'label'            => 'Timezone',
                                    'twb-layout'       => 'horizontal',
                                    'column-size'      => 'md-9',
                                    'label_attributes' => [
                                        'class' => 'col-md-3',
                                    ],
                                ],
                                'attributes'                 => [
                                    'class' => 'chosen-element',
                                ],
                                'type'                       => 'timezoneSelector',
                                'input_filter_specification' => [
                                    'required'   => true,
                                    'filters'    => [
                                        'StripTags'     => ['name' => 'StripTags'],
                                        'StringTrim'    => ['name' => 'StringTrim'],
                                        'StripNewlines' => ['name' => 'StripNewlines'],
                                        'Null'          => ['name' => 'Null'],
                                    ],
                                    'validators' => [],
                                ],
                            ],
                        'localization.country_code' =>
                            [
                                'name'                       => 'localization.country_code',
                                'options'                    => [
                                    'label'            => 'Country',
                                    'twb-layout'       => 'horizontal',
                                    'column-size'      => 'md-9',
                                    'label_attributes' => [
                                        'class' => 'col-md-3',
                                    ],
                                ],
                                'attributes'                 => [
                                    'class' => 'chosen-element',
                                ],
                                'type'                       => 'countrySelector',
                                'input_filter_specification' => [
                                    'required'   => true,
                                    'filters'    => [
                                        'StripTags'     => ['name' => 'StripTags'],
                                        'StringTrim'    => ['name' => 'StringTrim'],
                                        'StripNewlines' => ['name' => 'StripNewlines'],
                                        'Null'          => ['name' => 'Null'],
                                    ],
                                    'validators' => [],
                                ],
                            ],
                    ]
                ],
                'design'       => [
                    'label'    => 'Design',
                    'priority' => -21,
                    'element'  => [
                        'ze_theme.default_theme' =>
                            [
                                'name'                       => 'ze_theme.default_theme',
                                'options'                    => [
                                    'label'            => 'Theme',
                                    'twb-layout'       => 'horizontal',
                                    'column-size'      => 'md-9',
                                    'label_attributes' => [
                                        'class' => 'col-md-3',
                                    ],
                                    'value_options'    =>
                                        [
                                        ]
                                ],
                                'attributes'                 => [
                                    'class' => 'chosen-element',
                                ],
                                'type'                       => 'select',
                                'input_filter_specification' => [
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
                                    ],
                                ],
                            ],
                    ]
                ],
            ],
        ],
        'acmailer_options' => [
            'label'      => 'Email',
            'route'      => 'zfcadmin/system-settings/sections',
            'params'     => ['section' => 'acmailer_options'],
            'permission' => 'admin/system-settings/acmailer_options/view',
            'fieldset'   => [
                'mail_server_configuration'     => [
                    'label'    => 'Mail Server Configuration',
                    'priority' => -19,
                    'element'  => [
                        'acmailer_options.communications.enabled'                          =>
                            [
                                'name'                       => 'acmailer_options.communications.enabled',
                                'options'                    => [
                                    'label'            => 'Disable Email Communications',
                                    'twb-layout'       => 'horizontal',
                                    'column-size'      => 'md-8',
                                    'label_attributes' => [
                                        'class' => 'col-md-4',
                                    ],
                                    'value_options'    => [
                                        0 => 'Yes',
                                        1 => 'No'
                                    ]
                                ],
                                'attributes'                 => [
                                    'class' => 'chosen-element',
                                ],
                                'type'                       => 'select',
                                'input_filter_specification' => [
                                    'required'   => true,
                                    'filters'    => [
                                        'StripTags'     => ['name' => 'StripTags'],
                                        'StripNewlines' => ['name' => 'StripNewlines'],
                                        'StringTrim'    => ['name' => 'StringTrim'],
                                    ],
                                    'validators' => [
                                        [
                                            'name' => 'NotEmpty',
                                        ],
                                    ],
                                ],
                            ],
                        'acmailer_options.default.mail_adapter'                            =>
                            [
                                'name'                       => 'acmailer_options.default.mail_adapter',
                                'options'                    => [
                                    'label'            => 'Mail Protocol',
                                    'twb-layout'       => 'horizontal',
                                    'column-size'      => 'md-8',
                                    'label_attributes' => [
                                        'class' => 'col-md-4',
                                    ],
                                    'value_options'    =>
                                        [
                                            'sendmail'  => 'Mail',
                                            'smtp'      => 'SMTP',
                                            'file'      => 'Only log message to file',
                                            'in_memory' => 'Do nothing',
                                        ]
                                ],
                                'attributes'                 => [
                                    'class' => 'chosen-element',
                                ],
                                'type'                       => 'select',
                                'input_filter_specification' => [
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
                                    ],
                                ],
                            ],
                        'acmailer_options.default.smtp_options.host'                       =>
                            [
                                'name'                       => 'acmailer_options.default.smtp_options.host',
                                'options'                    => [
                                    'label'            => 'SMTP Hostname',
                                    'twb-layout'       => 'horizontal',
                                    'column-size'      => 'md-8',
                                    'label_attributes' => [
                                        'class' => 'col-md-4',
                                    ],
                                ],
                                'type'                       => 'text',
                                'input_filter_specification' => [
                                    'required'   => false,
                                    'filters'    => [
                                        'StripTags'     => ['name' => 'StripTags'],
                                        'StringTrim'    => ['name' => 'StringTrim'],
                                        'StripNewlines' => ['name' => 'StripNewlines'],
                                        'Null'          => ['name' => 'Null'],
                                    ],
                                    'validators' => [
                                        [
                                            'name'    => 'StringLength',
                                            'options' => [
                                                'encoding' => 'UTF-8',
                                                'max'      => 255,
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        'acmailer_options.default.smtp_options.connection_class'           =>
                            [
                                'name'                       => 'acmailer_options.default.smtp_options.connection_class',
                                'options'                    => [
                                    'label'            => 'Authentication Type',
                                    'twb-layout'       => 'horizontal',
                                    'column-size'      => 'md-8',
                                    'label_attributes' => [
                                        'class' => 'col-md-4',
                                    ],
                                    'value_options'    => [
                                        'smtp'    => 'Standard',
                                        'plain'   => 'Plain',
                                        'login'   => 'Login',
                                        'crammd5' => 'CRAM-MD5',
                                    ],
                                ],
                                'attributes'                 => [
                                    'class' => 'chosen-element',
                                ],
                                'type'                       => 'select',
                                'input_filter_specification' => [
                                    'filters'    => [
                                        'StripTags'     => ['name' => 'StripTags'],
                                        'StringTrim'    => ['name' => 'StringTrim'],
                                        'StripNewlines' => ['name' => 'StripNewlines'],
                                        'Null'          => ['name' => 'Null'],
                                    ],
                                    'validators' => [],
                                ],
                            ],
                        'acmailer_options.default.smtp_options.connection_config.username' =>
                            [
                                'name'                       => 'acmailer_options.default.smtp_options.connection_config.username',
                                'options'                    => [
                                    'label'            => 'SMTP Username',
                                    'twb-layout'       => 'horizontal',
                                    'column-size'      => 'md-8',
                                    'label_attributes' => [
                                        'class' => 'col-md-4',
                                    ],
                                ],
                                'type'                       => 'text',
                                'input_filter_specification' => [
                                    'required'   => false,
                                    'filters'    => [
                                        'StripTags'     => ['name' => 'StripTags'],
                                        'StringTrim'    => ['name' => 'StringTrim'],
                                        'StripNewlines' => ['name' => 'StripNewlines'],
                                        'Null'          => ['name' => 'Null'],
                                    ],
                                    'validators' => [
                                        [
                                            'name'    => 'StringLength',
                                            'options' => [
                                                'encoding' => 'UTF-8',
                                                'max'      => 255,
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        'acmailer_options.default.smtp_options.connection_config.password' =>
                            [
                                'name'                       => 'acmailer_options.default.smtp_options.connection_config.password',
                                'options'                    => [
                                    'label'            => 'SMTP Password',
                                    'twb-layout'       => 'horizontal',
                                    'column-size'      => 'md-8',
                                    'label_attributes' => [
                                        'class' => 'col-md-4',
                                    ],
                                ],
                                'type'                       => 'text',
                                'input_filter_specification' => [
                                    'required'   => false,
                                    'filters'    => [
                                        'StripTags'     => ['name' => 'StripTags'],
                                        'StringTrim'    => ['name' => 'StringTrim'],
                                        'StripNewlines' => ['name' => 'StripNewlines'],
                                        'Null'          => ['name' => 'Null'],
                                    ],
                                    'validators' => [
                                        [
                                            'name'    => 'StringLength',
                                            'options' => [
                                                'encoding' => 'UTF-8',
                                                'max'      => 255,
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        'acmailer_options.default.smtp_options.port'                       =>
                            [
                                'name'                       => 'acmailer_options.default.smtp_options.port',
                                'options'                    => [
                                    'label'            => ' SMTP Port',
                                    'twb-layout'       => 'horizontal',
                                    'column-size'      => 'md-8',
                                    'label_attributes' => [
                                        'class' => 'col-md-4',
                                    ],
                                ],
                                'type'                       => 'text',
                                'input_filter_specification' => [
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
                                            'name' => 'Digits',
                                        ],
                                        [
                                            'name'    => 'Between',
                                            'options' => [
                                                'min' => 1,
                                                'max' => 30000,
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        'acmailer_options.default.smtp_options.connection_config.ssl'      =>
                            [
                                'name'                       => 'acmailer_options.default.smtp_options.connection_config.ssl',
                                'options'                    => [
                                    'label'            => 'SSL Type',
                                    'twb-layout'       => 'horizontal',
                                    'column-size'      => 'md-8',
                                    'label_attributes' => [
                                        'class' => 'col-md-4',
                                    ],
                                    'value_options'    =>
                                        [
                                            ''    => 'None',
                                            'ssl' => 'SSL',
                                            'tls' => 'TLS',
                                        ],
                                ],
                                'attributes'                 => [
                                    'class' => 'chosen-element',
                                ],
                                'type'                       => 'select',
                                'input_filter_specification' => [
                                    'required'   => false,
                                    'filters'    => [
                                        'StripTags'     => ['name' => 'StripTags'],
                                        'StringTrim'    => ['name' => 'StringTrim'],
                                        'StripNewlines' => ['name' => 'StripNewlines'],
                                        'Null'          => ['name' => 'Null'],
                                    ],
                                    'validators' => [],
                                ],
                            ],
                    ],
                ],
                'contact_general'               => [
                    'label'    => 'General Contact',
                    'priority' => -21,
                    'element'  => [
                        'acmailer_options.contacts.general.name'  =>
                            [
                                'name'                       => 'acmailer_options.contacts.general.name',
                                'options'                    => [
                                    'label'            => 'Sender Name',
                                    'twb-layout'       => 'horizontal',
                                    'column-size'      => 'md-9',
                                    'label_attributes' => [
                                        'class' => 'col-md-3',
                                    ],
                                ],
                                'type'                       => 'text',
                                'input_filter_specification' => [
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
                                                'max'      => 120,
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        'acmailer_options.contacts.general.email' =>
                            [
                                'name'                       => 'acmailer_options.contacts.general.email',
                                'options'                    => [
                                    'label'            => 'Sender Email',
                                    'twb-layout'       => 'horizontal',
                                    'column-size'      => 'md-9',
                                    'label_attributes' => [
                                        'class' => 'col-md-3',
                                    ],
                                ],
                                'type'                       => 'text',
                                'input_filter_specification' => [
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
                                        [
                                            'name' => 'EmailAddress',
                                        ],
                                        'StringLength' => [
                                            'name'    => 'StringLength',
                                            'options' => [
                                                'encoding' => 'UTF-8',
                                                'min'      => 1,
                                                'max'      => 120,
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                    ]
                ],
                'contact_support'               => [
                    'label'    => 'Customer Support',
                    'priority' => -22,
                    'element'  => [
                        'acmailer_options.contacts.support.name'  =>
                            [
                                'name'                       => 'acmailer_options.contacts.support.name',
                                'options'                    => [
                                    'label'            => 'Sender Name',
                                    'twb-layout'       => 'horizontal',
                                    'column-size'      => 'md-9',
                                    'label_attributes' => [
                                        'class' => 'col-md-3',
                                    ],
                                ],
                                'type'                       => 'text',
                                'input_filter_specification' => [
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
                                                'max'      => 120,
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        'acmailer_options.contacts.support.email' =>
                            [
                                'name'                       => 'acmailer_options.contacts.support.email',
                                'options'                    => [
                                    'label'            => 'Sender Email',
                                    'twb-layout'       => 'horizontal',
                                    'column-size'      => 'md-9',
                                    'label_attributes' => [
                                        'class' => 'col-md-3',
                                    ],
                                ],
                                'type'                       => 'text',
                                'input_filter_specification' => [
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
                                        [
                                            'name' => 'EmailAddress',
                                        ],
                                        'StringLength' => [
                                            'name'    => 'StringLength',
                                            'options' => [
                                                'encoding' => 'UTF-8',
                                                'min'      => 1,
                                                'max'      => 120,
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                    ]
                ],
                'contact_website_administrator' => [
                    'label'    => 'Website Administrator Contact',
                    'priority' => -23,
                    'element'  => [
                        'acmailer_options.contacts.website_administrator.name'  =>
                            [
                                'name'                       => 'acmailer_options.contacts.website_administrator.name',
                                'options'                    => [
                                    'label'            => 'Sender Name',
                                    'twb-layout'       => 'horizontal',
                                    'column-size'      => 'md-9',
                                    'label_attributes' => [
                                        'class' => 'col-md-3',
                                    ],
                                ],
                                'type'                       => 'text',
                                'input_filter_specification' => [
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
                                                'max'      => 120,
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        'acmailer_options.contacts.website_administrator.email' =>
                            [
                                'name'                       => 'acmailer_options.contacts.website_administrator.email',
                                'options'                    => [
                                    'label'            => 'Sender Email',
                                    'twb-layout'       => 'horizontal',
                                    'column-size'      => 'md-9',
                                    'label_attributes' => [
                                        'class' => 'col-md-3',
                                    ],
                                ],
                                'type'                       => 'text',
                                'input_filter_specification' => [
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
                                        [
                                            'name' => 'EmailAddress',
                                        ],
                                        'StringLength' => [
                                            'name'    => 'StringLength',
                                            'options' => [
                                                'encoding' => 'UTF-8',
                                                'min'      => 1,
                                                'max'      => 120,
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                    ]
                ],
            ],
        ],
        'advanced'         => [
            'label'      => 'Advanced',
            'route'      => 'zfcadmin/system-settings/sections',
            'params'     => ['section' => 'advanced'],
            'permission' => 'admin/system-settings/advanced/view',
            'fieldset'   => [
                'developer' => [
                    'label'    => 'Developer Settings',
                    'priority' => -19,
                    'element'  => [
                        'zenddevelopertools.toolbar.enabled'    =>
                            [
                                'name'                       => 'zenddevelopertools.toolbar.enabled',
                                'options'                    => [
                                    'label'            => 'Debug Toolbar',
                                    'twb-layout'       => 'horizontal',
                                    'column-size'      => 'md-9',
                                    'label_attributes' => [
                                        'class' => 'col-md-3',
                                    ],
                                    'value_options'    => [
                                        0 => 'Disable',
                                        1 => 'Enable'
                                    ]
                                ],
                                'attributes'                 => [
                                    'class' => 'chosen-element',
                                ],
                                'type'                       => 'select',
                                'input_filter_specification' => [
                                    'required'   => true,
                                    'filters'    => [
                                        'StripTags'     => ['name' => 'StripTags'],
                                        'StringTrim'    => ['name' => 'StringTrim'],
                                        'StripNewlines' => ['name' => 'StripNewlines'],
                                    ],
                                    'validators' => [
                                        [
                                            'name' => 'Digits',
                                        ],
                                        [
                                            'name' => 'NotEmpty',
                                        ],
                                    ],
                                ],
                            ],
                        'doctrine.global_cache_instance'        =>
                            [
                                'name'                       => 'doctrine.global_cache_instance',
                                'options'                    => [
                                    'label'            => 'Doctrine ORM Cache',
                                    'twb-layout'       => 'horizontal',
                                    'column-size'      => 'md-9',
                                    'label_attributes' => [
                                        'class' => 'col-md-3',
                                    ],
                                    'value_options'    => [
                                        'array'      => 'Memory',
                                        'filesystem' => 'Filesystem',
                                        'apc'        => 'APC',
                                        'memcache'   => 'Memcache',
                                        'memcached'  => 'Memcached',
                                    ]
                                ],
                                'attributes'                 => [
                                    'class' => 'chosen-element',
                                ],
                                'type'                       => 'select',
                                'input_filter_specification' => [
                                    'required'   => true,
                                    'filters'    => [
                                        'StripTags'     => ['name' => 'StripTags'],
                                        'StringTrim'    => ['name' => 'StringTrim'],
                                        'StripNewlines' => ['name' => 'StripNewlines'],
                                    ],
                                    'validators' => [
                                        [
                                            'name' => 'NotEmpty',
                                        ],
                                    ],
                                ],
                            ],
                        'view_manager.display_exceptions'       =>
                            [
                                'name'                       => 'view_manager.display_exceptions',
                                'options'                    => [
                                    'label'            => 'Display Exceptions',
                                    'twb-layout'       => 'horizontal',
                                    'column-size'      => 'md-9',
                                    'label_attributes' => [
                                        'class' => 'col-md-3',
                                    ],
                                    'value_options'    => [
                                        0 => 'No',
                                        1 => 'Yes'
                                    ]
                                ],
                                'attributes'                 => [
                                    'class' => 'chosen-element',
                                ],
                                'type'                       => 'select',
                                'input_filter_specification' => [
                                    'required'   => true,
                                    'filters'    => [
                                        'StripTags'     => ['name' => 'StripTags'],
                                        'StringTrim'    => ['name' => 'StringTrim'],
                                        'StripNewlines' => ['name' => 'StripNewlines'],
                                    ],
                                    'validators' => [
                                        [
                                            'name' => 'Digits',
                                        ],
                                        [
                                            'name' => 'NotEmpty',
                                        ],
                                    ],
                                ],
                            ],
                        'view_manager.display_not_found_reason' =>
                            [
                                'name'                       => 'view_manager.display_not_found_reason',
                                'options'                    => [
                                    'label'            => 'Not Found Reason',
                                    'twb-layout'       => 'horizontal',
                                    'column-size'      => 'md-9',
                                    'label_attributes' => [
                                        'class' => 'col-md-3',
                                    ],
                                    'value_options'    => [
                                        0 => 'Hide',
                                        1 => 'Display'
                                    ]
                                ],
                                'attributes'                 => [
                                    'class' => 'chosen-element',
                                ],
                                'type'                       => 'select',
                                'input_filter_specification' => [
                                    'required'   => true,
                                    'filters'    => [
                                        'StripTags'     => ['name' => 'StripTags'],
                                        'StringTrim'    => ['name' => 'StringTrim'],
                                        'StripNewlines' => ['name' => 'StripNewlines'],
                                    ],
                                    'validators' => [
                                        [
                                            'name' => 'Digits',
                                        ],
                                        [
                                            'name' => 'NotEmpty',
                                        ],
                                    ],
                                ],
                            ],
                    ],
                ],
            ],
        ],
    ],
];
