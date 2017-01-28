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
use WellCart\Utility\Arr;
use Zend\Form\ElementInterface;
use Zend\Stdlib\PriorityList;


class LinearForm extends AbstractForm implements FormInterface
{
    /**
     * @var PriorityList
     */
    protected $toolbarActions;

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
    protected $uiConfigKey;

    /**
     * @inheritDoc
     */
    public function __construct($name = null, $options = [])
    {
        parent::__construct($name, $options);
        $this->toolbarActions = new PriorityList;
        $this->toolbarActions->isLIFO(false);
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
    public function getToolbarActions()
    {
        return $this->toolbarActions;
    }

    public function addToolbarAction($button, $priority = 0)
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
        $this->toolbarActions->insert(
            $name, $this->get($name), $priority
        );

        return $this;
    }


    public function getToolbarAction($name)
    {
        return $this->toolbarActions->get($name);
    }

    public function removeToolbarAction($name)
    {
        $this->getEventManager()->trigger
        (
            __FUNCTION__ . '.pre',
            $this,
            compact('name')
        );
        $this->toolbarActions->remove($name);
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
    public function getUiConfigKey()
    {
        return ($this->uiConfigKey) ? $this->uiConfigKey
            : $this->getName();
    }

    /**
     * @param string $uiConfigKey
     *
     * @return Form
     */
    public function setUiConfigKey(string $uiConfigKey)
    {
        $this->uiConfigKey = $uiConfigKey;

        return $this;
    }

}