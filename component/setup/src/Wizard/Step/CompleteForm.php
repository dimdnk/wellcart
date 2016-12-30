<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Setup\Wizard\Step;

use WellCart\Form\Form;

class CompleteForm extends Form
{

    /**
     * @param null $name
     */
    public function __construct($name = null)
    {
        parent::__construct($name);

        $this->getEventManager()->trigger('init', $this);
    }
}
