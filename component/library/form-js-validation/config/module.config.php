<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

return [
  'wellcart' => [
    'form_js_validation' => [
      'active_renderers' => [
        'form_js_validation.renderer.jquery_validate',
      ],
      'renderer_options' => [
        'form_js_validation.renderer.jquery_validate' => [
          'options_class' => 'WellCart\Form\JsValidation\Renderer\JqueryValidate\Options',
        ],
      ],
    ],
  ]
];
