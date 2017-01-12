<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Base\Factory\Service\Route;

use Interop\Container\ContainerInterface;
use WellCart\Base\Service\Route\Listing;

class ListingFactory
{

    public function __invoke(ContainerInterface $sm
    ): Listing {
        $config = $sm->get('config');

        return new Listing(
            $config['console']['router']['routes'],
            $config['router']['routes']
        );
    }
}
