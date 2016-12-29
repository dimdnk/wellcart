<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Base\EventListener\Entity;

use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use WellCart\Base\Exception\UnprocessableEntityException;
use WellCart\ORM\Entity;

class SystemEntityListener implements EventSubscriber
{

    /**
     * Specifies the list of events to listen
     *
     * @return array
     */
    public function getSubscribedEvents()
    {
        return [
            'preRemove',
        ];
    }

    public function preRemove(LifecycleEventArgs $args)
    {
        $object = $args->getObject();
        if ($object instanceof Entity
            && method_exists(
                $object,
                'isSystem'
            )
        ) {
            if ($object->isSystem()) {
                throw new UnprocessableEntityException(
                    'System records cannot be deleted.'
                );
            }
        }
    }
}
