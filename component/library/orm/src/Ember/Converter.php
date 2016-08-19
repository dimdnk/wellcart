<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\ORM\Ember;

use WellCart\Utility\Str;

class Converter
{
    /**
     * @var array
     */
    protected $classNames;

    /**
     * @param array $metadata
     *
     * @return array
     */
    public function processingMetadata(array $metadata)
    {
        $this->classNames = array();

        $entities = array();
        foreach ($metadata as $item) {
            if (!$item->isMappedSuperclass) {
                $class = array(
                    'name'       => $item->name,
                    'moduleName' => $this->getModuleName($item->name),
                    'modelName'  => $this->getModelName($item->name),
                    'fields'     => array(),
                );

                foreach ($item->fieldMappings as $field) {
                    if (!isset($field['id'])) {
                        $class['fields'][] = array(
                            'field_name'    => Str::camel2underscored(
                                $field['fieldName']
                            ),
                            'doctrine_type' => $field['type'],
                            'ember_type'    => $this->getEmberDataType(
                                $field['type']
                            ),
                        );
                    }
                }

                $entities[] = $class;
            }
        }

        return $entities;
    }

    protected function getModuleName($name)
    {
        $parts = explode('\\', $name);
        $vendor = (string)current($parts);
        $module = (string)next($parts);
        return $vendor . '.' . $module;
    }

    /**
     * @param string $name
     *
     * @return string
     */
    protected function getModelName($name)
    {
        $parts = explode('\\', $name);
        $model = $parts[count($parts) - 1];
        $modelOriginal = $model;

        $i = 2;
        while (in_array($model, $this->classNames)) {
            $model = $modelOriginal . $i;
            $i++;
        }

        $this->classNames[] = $model;

        return $model;
    }

    /**
     * @param string $type
     *
     * @return string
     */
    protected function getEmberDataType($type)
    {
        $result = 'string';

        if ($type == 'boolean') {
            $result = 'boolean';
        } elseif (in_array(
            $type, array('date', 'time', 'datetime', 'datetimetz')
        )) {
            $result = 'date';
        } elseif (in_array(
            $type, array('integer', 'smallint', 'bigint', 'decimal', 'float')
        )) {
            $result = 'number';
        }

        return $result;
    }
}
