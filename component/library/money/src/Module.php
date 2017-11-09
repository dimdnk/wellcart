<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types=1);

namespace WellCart\Money;

use WellCart\Money\Exception;

/**
 * Config Provider
 */
use Zend\ModuleManager\Feature\ConfigProviderInterface;

/**
 * Service Provider
 */
use Zend\ModuleManager\Feature\ServiceProviderInterface;

/**
 * Form Element Provider
 */
use Zend\ModuleManager\Feature\FormElementProviderInterface;

/**
 * Validator Provider
 */
use Zend\ModuleManager\Feature\ValidatorProviderInterface;

/**
 * View Helper Provider
 */
use Zend\ModuleManager\Feature\ViewHelperProviderInterface;

/**
 * @codeCoverageIgnore
 */
class Module implements
    ServiceProviderInterface,
    FormElementProviderInterface,
    ConfigProviderInterface,
    ValidatorProviderInterface,
    ViewHelperProviderInterface
{

    /**
     * @throws Exception\ExtensionNotLoadedException if ext/intl is not present
     */
    public function __construct()
    {
        if (!extension_loaded('intl')) {
            throw new Exception\ExtensionNotLoadedException(sprintf(
                '%s component requires the intl PHP extension',
                __NAMESPACE__
            ));
        }
    }

    /**
     * Return Service Config
     * @return array
     * @implements ServiceProviderInterface
     */
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'WellCart\Money\Service\CurrencyList' => 'WellCart\Money\Factory\CurrencyListFactory',
            ),
        );
    }

    /**
     * Include/Return module configuration
     * @return array
     * @implements ConfigProviderInterface
     */
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    /**
     * Get Form Element Config
     * @return array
     */
    public function getFormElementConfig()
    {
        return array(
            'factories' => array(
                'WellCart\Money\Form\Element\SelectCurrency' => 'WellCart\Money\Factory\CurrencySelectFactory',
            ),
            'aliases' => array(
                'SelectCurrency' => 'WellCart\Money\Form\Element\SelectCurrency',
            ),
            'invokables' => array(
                'WellCart\Money\Form\MoneyFieldset' => 'WellCart\Money\Form\MoneyFieldset',
                'WellCart\Money\Form\Element\Money' => 'WellCart\Money\Form\Element\Money',
            ),
            'initializers' => array(
                'WellCart\I18n\DefaultLocale',
            ),
        );
    }

    /**
     * Get validator config
     * @return array
     */
    public function getValidatorConfig()
    {
        return array(
            'factories' => array(
                'WellCart\Money\Validator\CurrencyCode' => 'WellCart\Money\Factory\CurrencyCodeValidatorFactory',
            ),
            'initializers' => array(
                'WellCart\I18n\DefaultLocale',
            ),
        );
    }

    public function getViewHelperConfig()
    {
        return array(
            'initializers' => array(
                'WellCart\I18n\DefaultLocale',
            ),
            'invokables' => array(
                'moneyFormat' => 'WellCart\Money\View\Helper\MoneyFormat',
                'formMoney' => 'WellCart\Money\View\Helper\FormMoney',
            ),
        );
    }
}
