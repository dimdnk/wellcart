<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
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

        $sections = [
            'fields', 'manyToMany',
            'oneToMany', 'manyToOne',
            'oneToOne', 'formFields'
        ];

        foreach ($sections as $section) {
            $this->populateDomainEntityInputFilterSpecification(
                $spec,
                $section,
                $className
            );
        }
        return $spec;
    }


    /**
     * Populate domain entity input filter specification
     *
     * @param array $spec
     * @param       $section
     * @param       $className
     */
    final protected function populateDomainEntityInputFilterSpecification(
        array &$spec,
        $section,
        $className
    ) {

        $fields = Config::get(
            'object_mapping.' . $className . '.' . $section,
            Config::get(
                'object_mapping.' . str_replace('\\', '\\\\', $className)
                . '.' . $section, []
            )
        );
        foreach ($fields as $field => $data) {
            if (empty($data['input_filter_specification'])) {
                unset($fields[$field]);
                continue;
            }
            $field = Str::camel2underscored($field);
            $spec[$field] = (array)$data['input_filter_specification'];
            Arr::set($spec, $field . '.name', $field);
            unset($fields[$field]);
        }
    }
}