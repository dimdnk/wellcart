<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Ui\Wizard\Step;

interface StepOptionsInterface
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
    public function getViewTemplate();

    /**
     * @param  string $template
     * @return self
     */
    public function setViewTemplate($template);
}