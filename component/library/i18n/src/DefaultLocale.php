<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types=1);

namespace WellCart\I18n;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Locale;

class DefaultLocale implements
    FactoryInterface
{

    protected $locale;

  public function __invoke(\Interop\Container\ContainerInterface $container, $requestedName,
    array $options = null
  ) {
    if (null === $this->locale) {
      $this->setLocaleFromConfig($container);
    }

    return $this;
  }

    /**
     * Set the current default locale by finding it in config
     * @param  ContainerInterface $serviceLocator
     * @return self
     */
    public function setLocaleFromConfig(ContainerInterface $serviceLocator)
    {
        /**
         * We could be getting a Form Element Manager, Validator Manager et al
         */
        if (is_subclass_of($serviceLocator, 'Zend\ServiceManager\ServiceManager')) {
            $serviceLocator = $serviceLocator->getServiceLocator();
        }
        $config = $serviceLocator->get('config');
        $locale = isset($config['wellcart']['localization']['locale']) ? $config['wellcart']['localization']['locale'] : Locale::getDefault();
        $this->setLocale($locale);

        return $this;
    }

    /**
     * Implements intializer interface
     * @param  mixed                   $instance
     * @param  ContainerInterface $serviceLocator
     * @return void
     */
    public function initialize($instance, ContainerInterface $serviceLocator)
    {
        /**
         * We might not have an object and without this, when the config
         * service is created (An array most likely), we will end up in an infinite loop
         * as setLocaleFromConfig() requires the config service
         */
        if ($instance === $this || !is_object($instance)) {
            return;
        }

        /**
         * Use this as an opportunity to set myself up
         */
        if (null === $this->locale) {
            $this->setLocaleFromConfig($serviceLocator);
        }

        /**
         * Inject based on interface
         */
        if ($instance instanceof LocaleAwareInterface) {
            $instance->setLocale($this->getLocale());
        }
    }

    /**
     * Set the default locale
     * @param  string $locale
     * @return self
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * Return the current default locale or return Locale::getDefault() if unset
     * @return string
     */
    public function getLocale()
    {
        if (null === $this->locale) {
            return Locale::getDefault();
        }

        return $this->locale;
    }

    /**
     * To string calls getLocale()
     * @return string
     */
    public function __toString()
    {
        return $this->getLocale();
    }
}
