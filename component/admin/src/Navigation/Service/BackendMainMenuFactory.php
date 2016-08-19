<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Admin\Navigation\Service;

use Zend\Navigation\Exception;
use Zend\Navigation\Service\DefaultNavigationFactory;

class BackendMainMenuFactory extends DefaultNavigationFactory
{
    /**
     * @{inheritdoc}
     */
    protected function getName()
    {
        return 'backend_main_navigation';
    }

    /**
     * @inheritDoc
     */
    protected function injectComponents(
        array $pages,
        $routeMatch = null,
        $router = null,
        $request = null
    ) {
        if ($routeMatch) {
            $matched = $routeMatch->getMatchedRouteName();
            foreach ($pages as &$page) {
                if (!empty($page['route'])) {
                    if ($matched == $page['route']) {
                        $page['active'] = true;
                    }
                }
            }
        }
        return parent::injectComponents(
            $pages,
            $routeMatch,
            $router,
            $request
        );
    }
}
