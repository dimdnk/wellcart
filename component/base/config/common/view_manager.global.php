<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
return
    ['view_manager' =>
        [
            'base_path' => '/',
            'display_not_found_reason' => false,
            'display_exceptions' => false,
            'doctype' => 'HTML5',
            'layout' => 'layout/page-fixed-1column',
            'not_found_template' => 'error/404',
            'exception_template' => 'error/index',
            'template_map' => [
                'partial/form/table-fieldset' => __DIR__
                    . '/../../view/partial/form/table-fieldset.phtml',
                'partial/form/layout/standard' => __DIR__
                    . '/../../view/partial/form/layout/standard.phtml',
                'partial/form/layout/tabbed' => __DIR__
                    . '/../../view/partial/form/layout/tabbed.phtml',
                'partial/navigation/menu/dropdown' => __DIR__
                    . '/../../view/partial/navigation/menu/dropdown.phtml',
                'partial/navigation/menu/accordion' => __DIR__
                    . '/../../view/partial/navigation/menu/accordion.phtml',
                'partial/paginator/default' => __DIR__
                    . '/../../view/partial/paginator/default.phtml',
                'partial/paginator/counters' => __DIR__
                    . '/../../view/partial/paginator/counters.phtml',
                'wellcart-base/item-view/notifications' => __DIR__
                    . '/../../view/item-view/notifications.phtml',
                'wellcart-base/item-view/html-notices' => __DIR__
                    . '/../../view/item-view/html-notices.phtml',
                'wellcart-base/item-view/html-footer' => __DIR__
                    . '/../../view/item-view/html-footer.phtml',
                'wellcart-base/item-view/flash-notifications' => __DIR__
                    . '/../../view/item-view/flash-notifications.phtml',
                'wellcart-base/item-view/html-head' => __DIR__
                    . '/../../view/item-view/html-head.phtml',
                'error/404' => __DIR__
                    . '/../../view/template/error/404.phtml',
                'error/index' => __DIR__
                    . '/../../view/template/error/index.phtml',
                'error' => __DIR__
                    . '/../../view/template/error/index.phtml',
                'wellcart-base/index/index' => __DIR__
                    . '/../../view/template/index/index.phtml',
                'wellcart-base/item-view/copyright' => __DIR__
                    . '/../../view/item-view/copyright.phtml',
                'item-view/text' => __DIR__
                    . '/../../view/item-view/text.phtml',
            ],
            'template_path_stack' => [],
            'strategies' => [
                'ViewJsonStrategy' => 'ViewJsonStrategy',
                'ViewFeedStrategy' => 'ViewFeedStrategy',
            ],
        ],
    ];
