<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\View\Factory\Helper;

use Interop\Container\ContainerInterface;
use WellCart\View\Helper\Locale;

class LocaleFactory
{
    public function __invoke(ContainerInterface $sm)
    {
        $locale = $sm->getServiceLocator()
            ->get('ControllerPluginManager')
            ->get('locale');
        $helper = new Locale($locale);
        return $helper;
    }
}
