<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\InputFilter;

use WellCart\ORM\Entity;
use WellCart\Utility\Arr;
use WellCart\Utility\Config;
use WellCart\Utility\Str;

trait DomainInputFilterSpecConfigTrait
{
    /**
     * Retrieve domain entity input filter specification
     *
     * @param Entity|string $entity
     *
     * @return array
     */
    final public function getDomainEntityInputFilterSpecification($entity)
    {
        $spec = [];
        $className = ($entity instanceof Entity) ?
            get_class($entity)
            : $entity;

        $fields = Config::get(
            'domain.input_filter.' . $className,
            Config::get(
                'domain.input_filter.'
                . str_replace('\\', '\\\\', $className),
                    []
            )
        );
        foreach ($fields as $field => $data) {
            $field = Str::camel2underscored($field);
            $spec[$field] = $data;
            Arr::set($spec, $field . '.name', $field);
            unset($fields[$field]);
        }
        return $spec;
    }
}