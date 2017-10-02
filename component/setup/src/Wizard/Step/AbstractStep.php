<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Setup\Wizard\Step;

use WellCart\Setup\Service\Setup;
use WellCart\Ui\Wizard\Step\AbstractStep as Step;

class AbstractStep extends Step
{

    /**
     * @var Setup
     */
    protected $setup;

    /**
     * @return Setup
     */
    public function getSetup()
    {
        return $this->setup;
    }

    /**
     * @param Setup $setup
     *
     * @return AbstractStep
     */
    public function setSetupService(Setup $setup)
    {
        $this->setup = $setup;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function toArray()
    {
        $array = parent::toArray();
        unset($array['setup']);

        return $array;
    }

    /**
     * {@inheritDoc}
     */
    public function getViewTemplate()
    {
        return $this->getOptions()->getViewTemplate();
    }

    /**
     * {@inheritDoc}
     */
    public function getTitle()
    {
        return $this->getOptions()->getTitle();
    }
}
