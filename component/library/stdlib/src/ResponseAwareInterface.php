<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\Stdlib;

use Zend\Stdlib\ResponseInterface;

interface ResponseAwareInterface
{

    /**
     * @param ResponseInterface $response
     *
     * @return void
     */
    public function setResponse(ResponseInterface $response);

    /**
     * @return ResponseInterface
     */
    public function getResponse();
}
