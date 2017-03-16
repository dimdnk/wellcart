<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types=1);

namespace WellCart\Directory\Factory\PageView\Backend;

use Interop\Container\ContainerInterface;
use WellCart\Directory\PageView\Backend\CurrenciesGrid;
use WellCart\Directory\Spec\CurrencyRepository;

class CurrenciesGridFactory
{
    public function __invoke(ContainerInterface $sm): CurrenciesGrid
    {
        return new CurrenciesGrid(
            $sm->get(CurrencyRepository::class),
            $sm
                ->get('Zend\Authentication\AuthenticationService')
                ->getIdentity()
                ->getTimeZone()
        );
    }
}
