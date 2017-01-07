<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
return [
  'ui' => [
    'form' =>
      [
        'cms_page' => [

          'elements' => [
            'save' => [
              'options'    => [
                'fontAwesome' => [
                  'icon' => 'check'
                ],
              ],
              'attributes' => [
                'class' => 'btn btn-toolbar-action btn-circle btn-success pull-right',
              ],
            ],

            'save_and_continue_edit' => [
                'options'    => [
                    'fontAwesome' => [
                        'icon' => 'check-circle'
                    ],
                ],
              'attributes' => [
                'class' => 'btn btn-toolbar-action btn-circle btn-success pull-right',
              ],
            ]
          ],

          'page' => [
            'elements' => [
              'status' => [
                'options'    => [
                  'twb-layout'          => 'horizontal',
                  'column-size'         => 'md-12',
                  'label_attributes'    => [
                    'class' => 'col-md-8 col-md-offset-4',
                  ],
                ],
                'attributes' => [
                  'class' => 'switchery-element',
                ],
              ],
              'url_key' => [
                  'options'    => [
                      'twb-layout'       => 'horizontal',
                      'column-size'      => 'md-8',
                      'label_attributes' => [
                          'class' => 'col-md-4',
                      ],
                  ],
              ],
            ],
            'translations' => [
              'elements' => [
                'title' => [
                  'options'    => [
                    'twb-layout'       => 'horizontal',
                    'column-size'      => 'md-8',
                    'label_attributes' => [
                      'class' => 'col-md-4',
                    ],
                  ],
                  'attributes' => [
                    'class' => 'form-control cms_page_title',
                  ],
                ],
                'body' => [
                  'options'    => [
                    'twb-layout'       => 'horizontal',
                    'column-size'      => 'md-8',
                    'label_attributes' => [
                      'class' => 'col-md-4',
                    ],
                  ],
                  'attributes' => [
                    'class' => 'wysiwyg-tinymce',
                    'rows'  => 50,
                  ],
                ],
                'meta_title' => [
                  'options'    => [
                    'twb-layout'       => 'horizontal',
                    'column-size'      => 'md-8',
                    'label_attributes' => [
                      'class' => 'col-md-4',
                    ],
                  ],
                ],
                'meta_keywords' => [
                  'options'    => [
                    'twb-layout'       => 'horizontal',
                    'column-size'      => 'md-8',
                    'label_attributes' => [
                      'class' => 'col-md-4',
                    ],
                  ],
                ],
                'meta_description' => [
                  'options'    => [
                    'twb-layout'       => 'horizontal',
                    'column-size'      => 'md-8',
                    'label_attributes' => [
                      'class' => 'col-md-4',
                    ],
                  ],
                ],
              ],
            ]
          ]
        ]
      ]
  ]
];
