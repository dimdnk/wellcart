<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Ui\Wizard;

interface WizardOptionsInterface
{
    /**
     * @return string
     */
    public function getTitle();

    /**
     * @param  string $title
     * @return self
     */
    public function setTitle($title);
    
    /**
     * @return string
     */
    public function getTokenParamName();

    /**
     * @param  string $name
     * @return self
     */
    public function setTokenParamName($name);

    /**
     * @return string
     */
    public function getLayoutTemplate();

    /**
     * @param  string $template
     * @return self
     */
    public function setLayoutTemplate($template);

    /**
     * @return string
     */
    public function getRedirectUrl();

    /**
     * @param  string $url
     * @return self
     */
    public function setRedirectUrl($url);

    /**
     * @return string
     */
    public function getCancelUrl();

    /**
     * @param  string $url
     * @return self
     */
    public function setCancelUrl($url);
}
