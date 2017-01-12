<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Form;

use WellCart\Utility\Arr;

trait AddAttributesToRequiredFieldsTrait
{

    /**
     * Add attributes to required fields
     *
     * @param array $specs
     */
    final protected function addAttributesToRequiredFields(array &$specs)
    {
        foreach ($specs as $field => &$data) {
            if ($this->has($field)) {
                $el = $this->get($field);
                $isRequired = (bool)Arr::get(
                    $data, 'required',
                    Arr::get(
                        $data,
                        'validators.NotEmpty'
                    )
                );

                if ($isRequired) {
                    $el->setAttribute('required', 'required');
                }
            }
            $validators = Arr::get(
                $data, 'validators', []
            );

            if (isset($this->object) && is_object($this->object)) {
                foreach ($validators as $k => $validator) {
                    Arr::set(
                        $data, 'validators.' . $k . '.options.domain_object',
                        $this->object
                    );
                }
            }
        }
    }
}