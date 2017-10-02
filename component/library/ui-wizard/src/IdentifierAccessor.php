<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Ui\Wizard\Wizard;

use Zend\Http\Request as HttpRequest;

class IdentifierAccessor
{
    /**
     * @var HttpRequest
     */
    protected $request;

    /**
     * @param  HttpRequest $request
     */
    public function __construct(HttpRequest $request)
    {
        $this->request = $request;
    }

    /**
     * @return string
     */
    public function getIdentifier($paramName)
    {
        $tokenValue = $this->request->getQuery($paramName, false);

        if ($tokenValue) {
            return $tokenValue;
        }

        return md5(uniqid((string)rand(), true));
    }
}
