<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types=1);

namespace WellCart\Money\Factory;

use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

//use Zend\Form\FormElementManager;

use WellCart\Money\Validator\CurrencyCode;

class CurrencyCodeValidatorFactory implements FactoryInterface
{
    /**
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return
     */
    public function createService(ServiceLocatorInterface $validatorManager)
    {
        $serviceLocator = $validatorManager->getServiceLocator();
        $list = $serviceLocator->get('WellCart\Money\Service\CurrencyList');
        $validator = new CurrencyCode;
        $validator->setCurrencyList($list);

        return $validator;
    }

}
