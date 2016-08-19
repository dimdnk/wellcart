<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Ui\Form;

use WellCart\Form\Form as AbstractForm;
use Zend\Stdlib\PriorityList;

class TabbedForm extends AbstractForm
{
    /**
     * @var
     */
    protected $tabs;

    /**
     * @var string
     */
    protected $layout = 'partial/form/layout/tabbed';

    /**
     * @param  null|int|string $name    Optional name for the element
     * @param  array           $options Optional options for the element
     */
    public function __construct($name = null, $options = [])
    {
        $this->tabs = new PriorityList();
        $this->tabs->isLIFO(false);
        parent::__construct($name, $options);
    }

    /**
     * @return mixed
     */
    public function getTabs()
    {
        return $this->tabs;
    }

    /**
     * @param       $id
     * @param       $label
     * @param array $attributes
     * @param array $formElements
     * @param int   $priority
     *
     * @return TabbedForm
     */
    public function addTab(
        $id,
        $label,
        array $attributes = [],
        array $formElements = [],
        $priority = 0
    ) {
        $tab = new Tab;
        $tab->isLIFO(false);
        $tab->setId($id)
            ->setLabel($label)
            ->setAttributes($attributes)
            ->setItems($formElements);
        $this->tabs->insert($id, $tab, $priority);
        return $this;
    }

    public function removeTab($id)
    {
        $this->tabs->remove($id);
        return $this;
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function getTab($id)
    {
        return $this->tabs->get($id);
    }

    /**
     * @return array
     */
    public function getNavTabsAttributes()
    {
        return array(
            'class' => 'nav nav-tabs',
        );
    }
}