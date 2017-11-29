<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\I18n\View\Helper;

use WellCart\Base\Spec\LocaleLanguageEntity;
use Zend\View\Helper\AbstractHelper;

class Locale extends AbstractHelper
{

    /**
     * @var \WellCart\I18n\Controller\Plugin\Locale
     */
    protected $plugin;

    public function __construct(\WellCart\I18n\Controller\Plugin\Locale $plugin
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
    public function getLanguage():?LocaleLanguageEntity
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