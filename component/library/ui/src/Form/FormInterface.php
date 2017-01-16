<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);
namespace WellCart\Ui\Form;

interface FormInterface
{
    public function backButton(bool $value = null);
    public function resetButton(bool $value = null);
    public function getToolbarButtons();
    public function addToolbarButton($button, $priority = 0);
    public function getToolbarButton($name);
    public function removeToolbarButton($name);
    public function getLayout();
    public function setLayout(string $layout);
    public function getUiConfigSection();
    public function setUiConfigSection(string $uiConfigSection);
}