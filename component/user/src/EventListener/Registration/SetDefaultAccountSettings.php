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
use WellCart\Base\Spec\LocaleLanguageEntity as LanguageEntity;
use WellCart\ServiceManager\ServiceLocatorAwareInterface;
use WellCart\ServiceManager\ServiceLocatorAwareTrait;
use WellCart\User\Spec\AclRoleEntity;
use WellCart\User\Spec\AclRoleRepository;
use Zend\EventManager\EventInterface;

class SetDefaultAccountSettings
{
    /**
     * @var LanguageEntity
     */
    protected $defaultLanguage;
    /**
     * @var AclRoleRepository
     */
    protected $roles;

    /**
     * Object constructor.
     * @param AclRoleRepository  $roles
     * @param LanguageEntity $defaultLanguage
     */
    public function __construct(
        AclRoleRepository $roles,
        LanguageEntity $defaultLanguage)
    {
        $this->roles =  $roles;
        $this->defaultLanguage =  $defaultLanguage;
    }

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

        $roles = $this->roles;

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
         * @var $language \WellCart\Base\Spec\LocaleLanguageEntity;
         */
        $language = $this->defaultLanguage;

        if ($language) {
            $user->setLanguage($language);
        }

        $user->setTimeZone($user->getTimeZone());
        return true;
    }
}
