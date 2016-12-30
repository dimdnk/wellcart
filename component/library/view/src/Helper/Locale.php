<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\View\Helper;

use Zend\View\Helper\AbstractHelper;

class Locale extends AbstractHelper
{
    /**
     * @var \WellCart\Mvc\Controller\Plugin\Locale
     */
    protected $plugin;

    public function __construct(\WellCart\Mvc\Controller\Plugin\Locale $plugin
    ) {
        $this->plugin = $plugin;
    }

    /**
     * Retrieve placeholder
     *
     * @return Locale
     */
    public function __invoke()
    {
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLanguages()
    {
        return $this->plugin->getLanguages();
    }

    /**
     * @return mixed
     */
    public function getDefaultLanguage()
    {
        return $this->plugin->getDefaultLanguage();
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->plugin->getLanguage();
    }

    /**
     * @return mixed
     */
    public function getTranslator()
    {
        return $this->plugin->getTranslator();
    }
}