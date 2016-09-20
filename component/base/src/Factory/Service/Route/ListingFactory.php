<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
namespace WellCart\Base\Factory\Service\Route;

use Interop\Container\ContainerInterface;
use WellCart\Base\Service\Route\Listing;

class ListingFactory
{
    public function __invoke(ContainerInterface $sm,
        $requestedName,
        array $options = null): Listing
    {
        $config = $sm->get('config');
        return new Listing(
            $config['console']['router']['routes'],
            $config['router']['routes']
        );
    }
}
