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

class AddRequiredFieldsToForm
{

    /**
     * @param EventInterface $e
     *
     * @return bool
     */
    public function __invoke(EventInterface $e)
    {
        /**
         * @var $form \ZfcUser\Form\Register
         */
        $form = $e->getTarget();

        $form->add(
            [
                'name'       => 'first_name',
                'type'       => 'Text',
                'options'    => [
                    'label' => __('First Name'),
                ],
                'attributes' => [
                    'autocomplete' => 'off',
                ],
            ]
        );

        $form->add(
            [
                'name'       => 'last_name',
                'type'       => 'Text',
                'options'    => [
                    'label' => __('Last Name'),
                ],
                'attributes' => [
                    'autocomplete' => 'off',
                ],
            ]
        );


        return true;
    }
}
