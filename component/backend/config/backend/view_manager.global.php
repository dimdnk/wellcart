<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

return [
    /**
     * =========================================================
     * View manager configuration
     * =========================================================
     */
    'view_manager' => [
        /**
         * Template map
         */
        'template_map' =>
            [
                'wellcart-backend/page-view/grid/standard/layout'         => __DIR__
                    . '/../../view/page-view/grid/standard/layout.phtml',
                'wellcart-backend/page-view/grid/standard/table'          => __DIR__
                    . '/../../view/page-view/grid/standard/table.phtml',
                'wellcart-backend/page-view/grid/standard/header-toolbar' => __DIR__
                    . '/../../view/page-view/grid/standard/header-toolbar.phtml',
                'wellcart-backend/page-view/grid/standard/footer-toolbar' => __DIR__
                    . '/../../view/page-view/grid/standard/footer-toolbar.phtml',
                'wellcart-backend/page-view/form/standard/layout'         => __DIR__
                    . '/../../view/page-view/form/standard/layout.phtml',
                'wellcart-backend/page-view/form/standard/toolbar'        => __DIR__
                    . '/../../view/page-view/form/standard/toolbar.phtml',
                'wellcart-backend/login/form'                             => __DIR__
                    . '/../../view/template/login/form.phtml',
                'wellcart-backend/recover-account/initiate'               => __DIR__
                    . '/../../view/template/recover-account/initiate.phtml',
                'wellcart-backend/recover-account/reset'                  => __DIR__
                    . '/../../view/template/recover-account/reset.phtml',
                'wellcart-backend/item-view/page-navigator'               => __DIR__
                    . '/../../view/item-view/page-navigator.phtml',
                'wellcart-backend/partial/settings/navigation'            => __DIR__
                    . '/../../view/partial/settings/navigation.phtml',
                'wellcart-backend/dashboard/index'                        => __DIR__
                    . '/../../view/template/dashboard/index.phtml',
                'wellcart-backend/settings/update'                        => __DIR__
                    . '/../../view/template/settings/update.phtml',
                'wellcart-backend/item-view/main-navigation-menu'         => __DIR__
                    . '/../../view/item-view/main-navigation-menu.phtml',
                'wellcart-backend/item-view/account/welcome-box'          => __DIR__
                    . '/../../view/item-view/account/welcome-box.phtml',
                'wellcart-backend/item-view/top-branding'                 => __DIR__
                    . '/../../view/item-view/top-branding.phtml',
                'wellcart-backend/partial/navigation/top-toolbar'         => __DIR__
                    . '/../../view/partial/navigation/top-toolbar.phtml',

                'wellcart-backend/item-view/page-head' => __DIR__
                    . '/../../view/item-view/page-head.phtml',
            ]
    ],

];