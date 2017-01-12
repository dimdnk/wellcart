<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\RestApi\Controller;

use WellCart\Mvc\Controller\AbstractRestfulController;
use WellCart\View\Model\HalJsonModel as ViewModel;

class HelloController extends AbstractRestfulController
{

    public function helloAction()
    {
        return new ViewModel(['welcome' => 'Hello, World!']);
    }

    /**
     * Pre-request action
     *
     * @param  $mvcEvent
     *
     * @return void
     */
    protected function preDispatch($mvcEvent)
    {
        $mvcEvent->setViewModel(new ViewModel());
    }
}
