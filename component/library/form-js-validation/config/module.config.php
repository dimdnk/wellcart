<?php
return [
  'stroker_form' => [
    'activeRenderers' => [
      'stroker_form.renderer.jqueryvalidate',
    ],
    'renderer_options' => [
      'stroker_form.renderer.jqueryvalidate' => [
        'options_class' => 'WellCart\Form\JsValidation\Renderer\JqueryValidate\Options',
      ],
    ],
    'jquery_validate_rule_plugins' => []
  ],
];
