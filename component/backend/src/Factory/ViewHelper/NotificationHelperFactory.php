<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Backend\Factory\ViewHelper;

use Interop\Container\ContainerInterface;
use WellCart\Backend\View\Helper\Notification as NotificationHelper;

class NotificationHelperFactory
{

    public function __invoke(ContainerInterface $sm
    ) {
        $notification = $sm->getServiceLocator()->get(
            'admin\notification'
        );

        return new NotificationHelper(
            $notification->recentCount(),
            $notification->recentMessages(5)
        );
    }
}
