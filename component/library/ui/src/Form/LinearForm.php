<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);
namespace WellCart\Ui\Form;

use WellCart\Form\Form as AbstractForm;
use Zend\Stdlib\PriorityList;


use WellCart\Utility\Arr;
use Zend\Form\ElementInterface;

class LinearForm extends AbstractForm implements FormInterface
{
    /**
     * @var PriorityList
     */
    protected $toolbarButtons;

    /**
     * @var bool
     */
    protected $backButton = true;

    /**
     * @var bool
     */
    protected $resetButton = true;

    /**
     * @var string
     */
    protected $layout = 'partial/form/layout/linear';

    /**
     * @var string
     */
    protected $uiConfigSection;

    /**
     * @inheritDoc
     */
    public function __construct($name = null, $options = [])
    {
        parent::__construct($name, $options);
        $this->toolbarButtons = new PriorityList;
        $this->toolbarButtons->isLIFO(false);
    }


    public function backButton(bool $value = null)
    {
        if ($value !== null) {
            $this->backButton = $value;
        }

        return $this->backButton;
    }

    public function resetButton(bool $value = null)
    {
        if ($value !== null) {
            $this->resetButton = $value;
        }

        return $this->resetButton;
    }

    /**
     * @return PriorityList
     */
    public function getToolbarButtons()
    {
        return $this->toolbarButtons;
    }

    public function addToolbarButton($button, $priority = 0)
    {
        if ($button instanceof ElementInterface) {
            $name = $button->getName();
            $button->setAttribute('value', $button->getLabel());
            $button->setAttribute(
                'data-disable-with', sprintf(
                    '<span class="fa fa-%s"></span> %s',
                    $button->getOption('fontAwesome')['icon'],
                    $button->getLabel()
                )
            );
        } else {
            $name = $button['name'];
            Arr::set($button, 'options.action_bar_button', true);
            Arr::set($button, 'attributes.role', 'button');
            Arr::set(
                $button, 'attributes.value', Arr::get($button, 'options.label')
            );
            Arr::set(
                $button, 'attributes.data-disable-with', sprintf(
                    '<span class="fa fa-%s"></span> %s',
                    Arr::get($button, 'options.fontAwesome.icon', 'check'),
                    Arr::get($button, 'options.label')
                )
            );
        }

        $this->add($button, ['priority' => $priority]);
        $this->toolbarButtons->insert(
            $name, $this->get($name), $priority
        );

        return $this;
    }


    public function getToolbarButton($name)
    {
        return $this->toolbarButtons->get($name);
    }

    public function removeToolbarButton($name)
    {
        $this->getEventManager()->trigger
        (
            __FUNCTION__ . '.pre',
            $this,
            compact('name')
        );
        $this->toolbarButtons->remove($name);
        $this->remove($name);
        $this->getEventManager()->trigger
        (
            __FUNCTION__ . '.post',
            $this,
            compact('name')
        );

        return $this;
    }


    /**
     * @return string
     */
    public function getLayout()
    {
        return $this->layout;
    }

    /**
     * @param string $layout
     *
     * @return Form
     */
    public function setLayout(string $layout)
    {
        $this->layout = $layout;

        return $this;
    }

    /**
     * @return string
     */
    public function getUiConfigSection()
    {
        return ($this->uiConfigSection) ? $this->uiConfigSection
            : $this->getName();
    }

    /**
     * @param string $uiConfigSection
     *
     * @return Form
     */
    public function setUiConfigSection(string $uiConfigSection)
    {
        $this->uiConfigSection = $uiConfigSection;

        return $this;
    }

}