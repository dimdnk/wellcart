<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);
namespace WellCart\View\Factory\Helper;

use Interop\Container\ContainerInterface;
use WellCart\View\Helper\Messenger;

class MessengerFactory
{

    /**
     * @param ContainerInterface $container
     *
     * @return Messenger
     */
    public function __invoke(ContainerInterface $container
    ): Messenger {
        $container = $container->getServiceLocator();
        $helper = new Messenger();
        $controllerPluginManager = $container->get(
            'ControllerPluginManager'
        );
        $messenger = $controllerPluginManager->get('messenger');
        $helper->setPluginFlashMessenger($messenger);
        $config = $container->get('Config');
        if (isset($config['view_helper_config']['flashmessenger'])) {
            $configHelper = $config['view_helper_config']['flashmessenger'];
            if (isset($configHelper['message_open_format'])) {
                $helper->setMessageOpenFormat(
                    $configHelper['message_open_format']
                );
            }
            if (isset($configHelper['message_separator_string'])) {
                $helper->setMessageSeparatorString(
                    $configHelper['message_separator_string']
                );
            }
            if (isset($configHelper['message_close_string'])) {
                $helper->setMessageCloseString(
                    $configHelper['message_close_string']
                );
            }
        }

        return $helper;
    }
}
