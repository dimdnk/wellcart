<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
namespace WellCart\Admin\Factory\ViewHelper;

use Interop\Container\ContainerInterface;
use WellCart\Admin\View\Helper\Notification as NotificationHelper;

class NotificationHelperFactory
{
    public function __invoke(ContainerInterface $sm,
        $requestedName,
        array $options = null)
    {
        $notification = $sm->getServiceLocator()->get(
            'admin\notification'
        );
        return new NotificationHelper(
            $notification->recentCount(),
            $notification->recentMessages(5)
        );
    }
}
