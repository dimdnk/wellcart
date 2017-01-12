<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\View\Factory\Helper;

use Interop\Container\ContainerInterface;
use WellCart\Utility\Config;
use WellCart\View\Helper\Date;

class DateFactory
{

    public function __invoke(ContainerInterface $sm)
    {
        try {
            $tz = $sm->getServiceLocator()
                ->get(
                    'Zend\Authentication\AuthenticationService'
                )
                ->getIdentity()
                ->getTimeZone();
        }
        catch (\Throwable $e) {
            $tz = Config::get('wellcart.localization.timezone');
        }

        return new Date($tz);
    }
}
