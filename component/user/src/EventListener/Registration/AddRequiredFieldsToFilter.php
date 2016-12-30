<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\User\EventListener\Registration;

use Zend\EventManager\EventInterface;

class AddRequiredFieldsToFilter
{

    /**
     * @param EventInterface $e
     *
     * @return bool
     */
    public function __invoke(EventInterface $e)
    {
        $filter = $e->getTarget();
        $filter->add(
            [
                'name'       => 'first_name',
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
            ]
        );

        $filter->add(
            [
                'name'       => 'last_name',
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
            ]
        );
        return true;
    }
}
