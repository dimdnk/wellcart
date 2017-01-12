<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Setup\Wizard\Step;

class Complete extends AbstractStep
{

    /**
     * {@inheritDoc}
     */
    public function init()
    {
        $this->setForm(new CompleteForm());
    }

    /**
     * {@inheritDoc}
     */
    public function process(array $data)
    {
        $form = $this->getForm();
        $form->setData($data);

        if ($form->isValid()) {
            return true;
        }

        return false;
    }

    /**
     * {@inheritDoc}
     */
    public function getViewTemplate()
    {
        $this->getSetup()->createInstalledManifest();

        return parent::getViewTemplate();
    }
}
