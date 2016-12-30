<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Ui\Factory\Datagrid\ViewHelper;

use Interop\Container\ContainerInterface;
use WellCart\Form\Form;
use WellCart\Ui\Datagrid\View\Helper\GridFilters;
use Zend\Form\Factory;

class GridFiltersFactory
{
    public function __invoke(ContainerInterface $sm)
    {
        $locator = $sm->getServiceLocator();
        $builder = $locator
            ->get('ControllerPluginManager')
            ->get('gridFilterBuilder');
        $form = new Form();
        $form->setFormFactory(
            new Factory($locator->get('FormElementManager'))
        );
        $helper = new GridFilters($builder, $form);
        return $helper;
    }
}