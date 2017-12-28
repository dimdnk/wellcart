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
use Zend\Form\FormElementManager;

use WellCart\Money\Form\Element\SelectCurrency;

class CurrencySelectFactory implements FactoryInterface
{

    /**
     * Return a Currency Select Instance
     * @return SelectCurrency
     */
    public function createService(ServiceLocatorInterface $formElementManager)
    {
        if (
          !$formElementManager instanceof FormElementManager\FormElementManagerV2Polyfill ||
          !$formElementManager instanceof FormElementManager\FormElementManagerV3Polyfill
        ) {
            throw new \UnexpectedValueException('Expected an instance of the Form Element Manager. Received '.get_class($formElementManager));
        }
        $appServices = $formElementManager->getServiceLocator();

        $list = $appServices->get('WellCart\Money\Service\CurrencyList');

        $select = new SelectCurrency;
        $select->setCurrencyList($list);

        $validatorManager = $appServices->get('ValidatorManager');
        $select->setValidator($validatorManager->get('WellCart\Money\Validator\CurrencyCode'));

        return $select;
  }

}
