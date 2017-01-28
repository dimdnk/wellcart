<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\Ui\Factory\Datagrid;

use Interop\Container\ContainerInterface;
use WellCart\Ui\Datagrid\Datagrid;

class DatagridFactory
{

    /**
     * @param ContainerInterface $container
     *
     * @return Datagrid
     */
    public function __invoke(ContainerInterface $container): Datagrid
    {
        $config = $container->get('config');

        /* @var $application \Zend\Mvc\Application */
        $application = $container->get('application');

        $grid = new Datagrid();
        $grid->setServiceLocator($container);
        $grid->setOptions($config['ZfcDatagrid']);
        $grid->setMvcEvent($application->getMvcEvent());
        $grid->setRendererName('HtmlDataGrid');
        /** @noinspection PhpParamsInspection */
        $grid->setRendererService(
            $container->get('zfcDatagrid.renderer.' . $grid->getRendererName())
        );
        $grid->init();

        return $grid;
    }
}