<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Ui\Wizard\Step;

use Zend\Stdlib\AbstractOptions;

class StepOptions extends AbstractOptions implements StepOptionsInterface
{
    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $viewTemplate;

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
    public function getViewTemplate()
    {
        return $this->viewTemplate;
    }

    /**
     * {@inheritDoc}
     */
    public function setViewTemplate($template)
    {
        $this->viewTemplate = (string) $template;
        return $this;
    }
}
