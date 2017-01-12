<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\Redirect as AbstractPlugin;

class Redirect extends AbstractPlugin
{

    /**
     * @return \Zend\Http\Response
     */
    public function refresh()
    {
        $request = $this->getController()->getRequest();
        $referer = $request->getHeader('Referer');
        if ($referer) {
            $refererUrl = $referer->uri()->getPath(); // referer url
            $refererHost = $referer->uri()->getHost(); // referer host
            $host = $request->getUri()->getHost(); // current host

            // only redirect to previous page if request comes from same host
            if ($refererUrl && ($refererHost == $host)) {
                return $this->toUrl($refererUrl);
            }
        }

        return $this->toRoute('wellcart-base:home');

    }
}