<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\I18n\View\Factory\Helper;

use Interop\Container\ContainerInterface;
use WellCart\I18n\View\Helper\Locale;

class LocaleFactory
{

    public function __invoke(ContainerInterface $sm): Locale
    {
        $locale = $sm->getServiceLocator()
            ->get('ControllerPluginManager')
            ->get('locale');
        $helper = new Locale($locale);

        return $helper;
    }
}
