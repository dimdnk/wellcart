<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\User\EventListener\Registration;

use WellCart\Admin\Spec\AdministratorEntity;
use WellCart\ServiceManager\ServiceLocatorAwareInterface;
use WellCart\ServiceManager\ServiceLocatorAwareTrait;
use Zend\EventManager\EventInterface;

class SetDefaultAccountSettings implements ServiceLocatorAwareInterface
{

    use ServiceLocatorAwareTrait;

    /**
     * @param EventInterface $e
     *
     * @return bool
     */
    public function __invoke(EventInterface $e)
    {
        /**
         * @var $user \WellCart\User\Spec\UserEntity
         */
        $user = $e->getParam('user');

        $roles = $this->getServiceLocator()->get(
            'WellCart\User\Spec\AclRoleRepository'
        );

        /**
         * @var $role \WellCart\User\Spec\AclRoleEntity
         */
        $role = $roles->findDefaultRole();

        if ($role) {
            $user->addRole($role);
        }

        if ($user instanceof AdministratorEntity) {
            $user->addRole($roles->findOneBy(['name' => 'admin']));
        }

        /**
         * @var $role \WellCart\Base\Spec\LocaleLanguageEntity;
         */
        $language = $this->getServiceLocator()->get(
            'WellCart\Base\Spec\LocaleLanguageRepository'
        )->findDefaultLanguage();

        if ($language) {
            $user->setLanguage($language);
        }

        $user->setTimeZone($user->getTimeZone());
        return true;
    }
}
