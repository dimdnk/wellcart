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
    public function getToolbarActions();
    public function addToolbarAction($button, $priority = 0);
    public function getToolbarAction($name);
    public function removeToolbarAction($name);
    public function getLayout();
    public function setLayout(string $layout);
    public function getUiConfigKey();
    public function setUiConfigKey(string $uiConfigKey);
}