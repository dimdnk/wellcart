<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Ui\Wizard;

use Zend\Stdlib\AbstractOptions;

class WizardOptions extends AbstractOptions implements WizardOptionsInterface
{
    /**
     * @var bool
     */
    protected $__strictMode__ = false;
    
    /**
     * @var string 
     */
    protected $title;

    /**
     * @var string
     */
    protected $tokenParamName = 'uid';

    /**
     * @var string
     */
    protected $layoutTemplate;

    /**
     * @var string
     */
    protected $redirectUrl;

    /**
     * @var string
     */
    protected $cancelUrl;

    /**
     * {@inheritDoc}
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * {@inheritDoc}
     */
    public function setTitle($title)
    {
        $this->title = (string) $title;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getTokenParamName()
    {
        return $this->tokenParamName;
    }

    /**
     * {@inheritDoc}
     */
    public function setTokenParamName($name)
    {
        $this->tokenParamName = (string) $name;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getLayoutTemplate()
    {
        return $this->layoutTemplate;
    }

    /**
     * {@inheritDoc}
     */
    public function setLayoutTemplate($template)
    {
        $this->layoutTemplate = (string) $template;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getRedirectUrl()
    {
        return $this->redirectUrl;
    }

    /**
     * {@inheritDoc}
     */
    public function setRedirectUrl($url)
    {
        $this->redirectUrl = (string) $url;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getCancelUrl()
    {
        return $this->cancelUrl;
    }

    /**
     * {@inheritDoc}
     */
    public function setCancelUrl($url)
    {
        $this->cancelUrl = (string) $url;
        return $this;
    }
}
