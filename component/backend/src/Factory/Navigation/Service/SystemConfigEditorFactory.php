<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Backend\Factory\Navigation\Service;

use Interop\Container\ContainerInterface;
use Zend\Navigation\Exception;
use Zend\Navigation\Service\AbstractNavigationFactory;

class SystemConfigEditorFactory extends AbstractNavigationFactory
{

    /**
     * @param ContainerInterface $container
     *
     * @return array
     * @throws \Zend\Navigation\Exception\InvalidArgumentException
     */
    protected function getPages(ContainerInterface $container)
    {
        if (null === $this->pages) {
            $configuration = $container->get('Config');

            if (!isset($configuration['system_config_editor'])) {
                throw new Exception\InvalidArgumentException(
                    'Could not find navigation configuration key'
                );
            }
            if (!isset($configuration['system_config_editor'][$this->getName()])
            ) {
                throw new Exception\InvalidArgumentException(
                    sprintf(
                        'Failed to find a navigation container by the name "%s"',
                        $this->getName()
                    )
                );
            }

            $pages = $this->getPagesFromConfig(
                $configuration['system_config_editor'][$this->getName()]
            );
            $this->pages = $this->preparePages($container, $pages);
        }

        return $this->pages;
    }

    /**
     * @{inheritdoc}
     */
    protected function getName()
    {
        return 'tabs';
    }
}
