<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Theme\FrontendUi;

use ConLayout\ModuleManager\Feature\BlockProviderInterface;
use WellCart\ModuleManager\Feature\ModulePathProviderInterface;
use WellCart\ModuleManager\Feature\VersionProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements
    ConfigProviderInterface,
    VersionProviderInterface,
    ModulePathProviderInterface,
    BlockProviderInterface
{

    /**
     * Theme version
     *
     * @var string
     */
    const VERSION = '0.1.0';

    /**
     * Retrieve theme version
     *
     * @return string
     */
    final public function getVersion()
    {
        return self::VERSION;
    }

    /**
     * Expected to return absolute path to theme directory
     *
     * @return string
     */
    public function getAbsolutePath()
    {
        return str_replace('\\', DS, dirname(__DIR__)) . DS;
    }

    /**
     * Returns configuration to merge with application configuration
     *
     * @return array|\Traversable
     */
    public function getConfig()
    {
        return [
            'design'               => [
                'theme' => [
                    'wellcart-frontend-ui' =>
                        include __DIR__
                            . '/../config/theme.php'
                ]
            ],
            /**
             * =========================================================
             * Translator configuration
             * =========================================================
             */
            'translator'           => [
                'translation_file_patterns' => [
                    __FILE__ => [
                        'text_domain' => 'default',
                        'type'        => 'gettext',
                        'base_dir'    => __DIR__ . '/../language',
                        'pattern'     => '%s.mo',
                    ],
                ],
            ],
            /**
             * =========================================================
             * Static assets configuration
             * =========================================================
             */
            'asset_manager'        => [
                'resolver_configs' => [
                    'paths' => [
                        __DIR__ => __DIR__ . '/../public/',
                    ],
                ],
            ],
            'layout_updates'       => include __DIR__
                . '/../config/layout_updates.php',
            'system_config_editor' => [
                'tabs' => [
                    'general' => [
                        'fieldsets' => [
                            'design' => [
                                'elements' => [
                                    'wellcart.theme.default_theme' =>
                                        [
                                            'options' => [
                                                'value_options' =>
                                                    [
                                                        'wellcart-frontend-ui' => 'WellCart Frontend UI',
                                                    ]
                                            ],
                                        ],
                                ]
                            ],
                        ],
                    ],
                ],
            ],
        ];
    }

    /**
     * Retrieve block config
     *
     * @return array
     */
    public function getBlockConfig()
    {
        return [
            'factories' => [],
            'shared'    => [],
        ];
    }
}
