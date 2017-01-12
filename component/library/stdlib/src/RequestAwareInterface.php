<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Stdlib;

use Zend\Stdlib\RequestInterface;

interface RequestAwareInterface
{

    /**
     * @param RequestInterface $request
     *
     * @return void
     */
    public function setRequest(RequestInterface $request);

    /**
     * @return RequestInterface
     */
    public function getRequest();
}
