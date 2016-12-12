<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Base\Factory\FormElement;

use Interop\Container\ContainerInterface;

class TranslatableCollectionFactory
{
    /**
     * @param ContainerInterface $sm
     *
     * @return \WellCart\Form\Element\TranslatableCollection
     */
    public function __invoke(ContainerInterface $sm
    ): \WellCart\Form\Element\TranslatableCollection
    {
        $services = $sm->getServiceLocator();
        $languages = $services->get(
            'locale\active_languages_collection'
        );
        return new \WellCart\Form\Element\TranslatableCollection(
            null,
            ['languages_collection' => $languages]
        );
    }
}
