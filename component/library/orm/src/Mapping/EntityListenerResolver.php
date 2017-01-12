<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
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
        $className = trim($className, '\\');
        $locator = $this->getServiceLocator();
        if ($locator->has($className)) {
            return $locator->get($className);
        }

        return parent::resolve($className);
    }

}
