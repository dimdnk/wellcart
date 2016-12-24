<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Backend\EventListener;

use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use WellCart\Backend\Spec\NotificationEntity;

class NotificationEntityListener
{
    public function preRemove(
        NotificationEntity $notification,
        LifecycleEventArgs $event
    ) {
        $em = $event->getObjectManager();
        $notification->setIsRead(true)
            ->setIsDeleted(true);
        $em->persist($notification);
        $em->flush($notification);
    }
}
