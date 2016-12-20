<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Admin\Command;

use WellCart\Admin\Spec\AdministratorEntity;

final class PersistBackendAccount
{
    /**
     * @var AdministratorEntity
     */
    private $admin;
    /**
     * @var array
     */
    private $data;

    public function __construct(AdministratorEntity $admin, array $data)
    {
        $this->setAdministrator($admin);
        $this->data = $data;
    }

    /**
     * @param AdministratorEntity $admin
     *
     * @return $this
     */
    public function setAdministrator(AdministratorEntity $admin)
    {
        $this->admin = $admin;
        return $this;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    public function getEntity()
    {
        return $this->getAdministrator();
    }

    /**
     * @return AdministratorEntity
     */
    public function getAdministrator(): AdministratorEntity
    {
        return $this->admin;
    }
}
