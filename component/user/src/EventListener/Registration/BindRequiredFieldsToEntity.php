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

class BindRequiredFieldsToEntity
{

    /**
     * @param EventInterface $e
     *
     * @return bool
     */
    public function __invoke(EventInterface $e)
    {
        $filter = $e->getParam('form')->getInputFilter();
        $user = $e->getParam('user');
        /* @var $user \WellCart\User\Spec\UserEntity */
        $user->setFirstName($filter->get('first_name')->getValue());
        $user->setLastName($filter->get('last_name')->getValue());

        return true;
    }
}
