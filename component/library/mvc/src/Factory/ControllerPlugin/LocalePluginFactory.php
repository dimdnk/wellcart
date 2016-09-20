<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Mvc\Factory\ControllerPlugin;

use Interop\Container\ContainerInterface;
use WellCart\Mvc\Controller\Plugin\Locale as LocaleControllerPlugin;
use WellCart\Base\Entity\Locale\Language\DefaultLanguage;

class LocalePluginFactory
{
    /**
     * @param ContainerInterface $sm
     * @param                    $requestedName
     * @param array|null         $options
     *
     * @return LocaleControllerPlugin
     */
    public function __invoke(
        ContainerInterface $sm,
        $requestedName,
        array $options = null
    ): LocaleControllerPlugin
    {        $services = $sm->getServiceLocator();
        $translator = $services->get('MvcTranslator');
        try {
            $languages = $services->get(
                'locale\active_languages_collection'
            );
            $defaultLanguage = $languages->current();
        } catch (\Throwable $e) {
            $languages
                = new \Doctrine\Common\Collections\ArrayCollection(
            );
            $defaultLanguage = new DefaultLanguage();
        }


        return new LocaleControllerPlugin(
            $languages,
            $defaultLanguage,
            $defaultLanguage,
            $translator
        );
    }
}
