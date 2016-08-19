<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Mvc\Controller\Feature\Crud;

use WellCart\Mvc\Exception\AccessDeniedException;

trait ActionGrantedTrait
{
    protected function isGrantedOrDeny($permission)
    {
        if (!$this->isGranted($permission)) {
            throw new AccessDeniedException(
                sprintf(
                    'Access denied to "%s" for "%s".', $permission,
                    $this->identity() ? $this->identity()->getDisplayName()
                        : 'guest'
                )
            );
        }
        return true;
    }
}