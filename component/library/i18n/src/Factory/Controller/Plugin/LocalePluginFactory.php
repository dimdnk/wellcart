<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\I18n\Factory\Controller\Plugin;

use Interop\Container\ContainerInterface;
use WellCart\Base\Entity\Locale\Language\DefaultLanguage;
use WellCart\I18n\Controller\Plugin\Locale as LocaleControllerPlugin;

class LocalePluginFactory
{

    /**
     * @param ContainerInterface $sm
     *
     * @return LocaleControllerPlugin
     */
    public function __invoke(
        ContainerInterface $sm
    ): LocaleControllerPlugin {
        $services = $sm->getServiceLocator();
        $translator = $services->get('MvcTranslator');
        try {
            $languages = $services->get(
                'locale\active_languages_collection'
            );
            $defaultLanguage = $languages->current();
        } catch (\Throwable $e) {
            $languages
                = new \Doctrine\Common\Collections\ArrayCollection();
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
