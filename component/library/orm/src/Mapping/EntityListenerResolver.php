<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\ORM\Mapping;

use Doctrine\ORM\Mapping\DefaultEntityListenerResolver;
use WellCart\ServiceManager\ServiceLocatorAwareInterface;
use WellCart\ServiceManager\ServiceLocatorAwareTrait;

class EntityListenerResolver extends DefaultEntityListenerResolver
    implements ServiceLocatorAwareInterface
{
    use ServiceLocatorAwareTrait;

    /**
     * {@inheritdoc}
     */
    public function resolve($className)
    {
        $listener = parent::resolve($className);
        if ($listener instanceof ServiceLocatorAwareInterface) {
            $listener->setServiceLocator($this->getServiceLocator());
        }
        return $listener;
    }

}
