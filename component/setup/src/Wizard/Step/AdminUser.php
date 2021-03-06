<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Setup\Wizard\Step;

class AdminUser extends AbstractStep
{

    /**
     * {@inheritDoc}
     */
    public function init()
    {
        $this->setForm(new AdminUserForm());
    }

    /**
     * {@inheritDoc}
     */
    public function process(array $data)
    {
        $form = $this->getForm();
        $form->setData($data);
        if ($form->isValid()) {
            $data = $form->getData();

            return $this->getSetup()->createAdminAccount($data);
        }

        return false;
    }
}
