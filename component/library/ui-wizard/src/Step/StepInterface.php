<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Ui\Wizard\Step;

use Traversable;
use WellCart\Ui\Wizard\Exception;
use WellCart\Ui\Wizard\Wizard;
use Zend\Form\FormInterface;

interface StepInterface
{
    /**
     * @void
     */
    public function init();

    /**
     * @param  string $name
     * @return self
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param  array|Traversable|StepOptionsInterface $options
     * @return self
     */
    public function setOptions($options);

    /**
     * @return StepOptionsInterface
     */
    public function getOptions();

    /**
     * @param  Wizard $wizard
     * @return self
     */
    public function setWizard(Wizard $wizard);

    /**
     * @return Wizard
     */
    public function getWizard();

    /**
     * @param  FormInterface $form
     * @return self
     */
    public function setForm(FormInterface $form);

    /**
     * @return FormInterface
     */
    public function getForm();

    /**
     * @param  array $data
     * @return self
     */
    public function setData(array $data);

    /**
     * @return array
     */
    public function getData();

    /**
     * @param  array $data
     * @return void|bool
     */
    public function process(array $data);

    /**
     * @param  bool $complete
     * @return self
     */
    public function setComplete($complete = true);

    /**
     * @return bool
     */
    public function isComplete();

    /**
     * @param  array|Traversable $options
     * @throws Exception\InvalidArgumentException
     * @return self
     */
    public function setFromArray($options);

    /**
     * @return array
     */
    public function toArray();
}