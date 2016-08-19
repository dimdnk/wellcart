<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Form\Element;

use Interop\Container\ContainerInterface;
use WellCart\Directory\Spec\CurrencyEntity;

class ProductPriceFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return ProductPrice
     */
    public function __invoke(ContainerInterface $container): ProductPrice
    {
        /**
         * @var $currency CurrencyEntity
         */
        $currency = $container->getServiceLocator()->get(
            'directory\primary_currency'
        );
        $productPrice = new ProductPrice(null, [], $currency);
        return $productPrice;
    }
}
