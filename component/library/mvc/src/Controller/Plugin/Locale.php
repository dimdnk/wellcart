<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Mvc\Controller\Plugin;

use Doctrine\Common\Collections\Collection;
use WellCart\Base\Spec\LocaleLanguageEntity as Language;
use Zend\I18n\Translator\TranslatorInterface;
use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class Locale extends AbstractPlugin
{

    /**
     * Language entities
     */
    protected $languages;

    protected $defaultLanguage;

    protected $language;

    protected $translator;

    public function __construct(
        Collection $languages,
        Language $defaultLanguage,
        Language $language,
        TranslatorInterface $translator
    ) {
        $this->languages = $languages;
        $this->defaultLanguage = $defaultLanguage;
        $this->language = $language;
        $this->translator = $translator;
    }

    /**
     * @return mixed
     */
    public function getLanguages()
    {
        return $this->languages;
    }

    /**
     * @return mixed
     */
    public function getDefaultLanguage()
    {
        return $this->defaultLanguage;
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @return mixed
     */
    public function getTranslator()
    {
        return $this->translator;
    }


}