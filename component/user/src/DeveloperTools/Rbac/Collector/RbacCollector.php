<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\User\DeveloperTools\Rbac\Collector;

class RbacCollector extends \ZfcRbac\Collector\RbacCollector
{

    /**
     * @return array|string[]
     */
    public function getCollection()
    {
        $collection = parent::getCollection();
        if (empty($collection)) {
            $collection = [
                'guards'      => $this->collectedGuards,
                'roles'       => $this->collectedRoles,
                'permissions' => $this->collectedPermissions,
                'options'     => $this->collectedOptions
            ];
        }
        return $collection;
    }
}
