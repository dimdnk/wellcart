<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Setup\Wizard\Step;

class Requirements extends AbstractStep
{

    /**
     * {@inheritDoc}
     */
    public function init()
    {
        $this->setForm(new RequirementsForm());
    }

    /**
     * {@inheritDoc}
     */
    public function process(array $data)
    {
        $form = $this->getForm();
        $form->setData($data);
        $requirements = $this->getSetup()->checkRequirements();
        $isValid = true;
        foreach ($requirements as $group) {
            foreach ($group as $item) {
                if (!$item['success']) {
                    $isValid = false;
                    break 2;
                }
            }
        }

        return ($form->isValid() && $isValid);
    }
}
