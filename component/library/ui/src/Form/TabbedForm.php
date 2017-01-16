<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Ui\Form;

use WellCart\Ui\Form\LinearForm as AbstractForm;
use WellCart\Utility\Arr;
use Zend\Stdlib\PriorityList;

class TabbedForm extends AbstractForm implements FormInterface
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
     * @inheritDoc
     */
    public function setOptions($options)
    {
        parent::setOptions(
            $options
        );

        if (isset($options['tabs'])) {
            $this->setTabsSpecification($options['tabs']);
        }

        return $this;
    }

    public function setTabsSpecification(array $tabs)
    {
        foreach ($tabs as $tabId => $tab)
        {
            $this->addTab($tabId,
               __(Arr::get($tab, 'label','')),
                Arr::get($tab, 'elements', []),
                Arr::get($tab, 'options', []),
                Arr::get($tab, 'attributes', []),
                Arr::get($tab, 'priority', 0)
            );
        }
        return $this;
    }


    /**
     * @return mixed
     */
    public function getTabs()
    {
        return $this->tabs;
    }

    /**
     * @param string $id
     * @param string $label
     * @param array $elements
     * @param array $options
     * @param array $attributes
     * @param int   $priority
     *
     * @return TabbedForm
     */
    public function addTab(
        $id,
        $label,
        array $elements = [],
        array $options = [],
        array $attributes = [],
        $priority = 0
    ) {
        $tab = new Tab\Tab;
        $tab->isLIFO(false);
        $tab->setId($id)
            ->setLabel($label)
            ->setOptions($options)
            ->setAttributes($attributes);

        foreach ($elements as $element) {
            if(is_string($element)) {
                $element = $this->get($element);
            }
            $tab->add($element->getName(), $element);
        }
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
        return [
            'class' => 'nav nav-tabs',
        ];
    }
}