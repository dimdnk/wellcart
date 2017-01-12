<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Command;


use WellCart\Catalog\Form\Product;
use WellCart\CommandBus\Command\PersistEntity;
use WellCart\Form\Form;

class PersistProduct extends PersistEntity
{

    /**
     * @var Form
     */
    protected $form;

    /**
     * @return Form
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * @param Form $form
     *
     * @return PersistProduct
     */
    public function setForm(Product $form)
    {
        $this->form = $form;

        return $this;
    }
}
