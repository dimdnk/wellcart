<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Base\Factory\FormElement;

use Interop\Container\ContainerInterface;

class LocaleLanguageSelectorFactory
{

    /**
     * @param ContainerInterface $sm
     *
     * @return \WellCart\Form\Element\Select
     */
    public function __invoke(ContainerInterface $sm
    ): \WellCart\Form\Element\Select {
        $services = $sm->getServiceLocator();
        $languages = $services->get(
            'locale\active_languages_collection'
        );
        $options = [];
        foreach ($languages as $language) {
            $options[$language->getId()] = $language->getName();
        }

        return new \WellCart\Form\Element\Select(
            null,
            ['value_options' => $options]
        );
    }
}
