<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Admin\Form;

use WellCart\User\Form\RecoverAccount as RecoverUserAccountForm;

class RecoverAccount extends RecoverUserAccountForm
{
    /**
     * Input filter specification
     *
     * @return array
     */
    public function getInputFilterSpecification()
    {
        $specification = [
            'email' =>
                [
                    'name'       => 'email',
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
                        'EmailAddress' => [
                            'name' => 'EmailAddress',
                        ],
                        'StringLength' => [
                            'name'    => 'StringLength',
                            'options' => [
                                'encoding' => 'UTF-8',
                                'min'      => 1,
                                'max'      => 255,
                            ],
                        ],
                        'ObjectExists' => [
                            'name'    => 'WellCart\ORM\Validator\ObjectExists',
                            'options' => [
                                'entity_class' => 'WellCart\Admin\Entity\Administrator',
                                'fields'       => ['email'],
                                'messages'     => [
                                    'noObjectFound' => 'No such user exists. Please make sure that you entered your email correctly.'
                                ],
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
