<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Ui\Container\ItemView;

use ConLayout\Block\BlockInterface;
use WellCart\Mvc;
use WellCart\Stdlib;
use WellCart\Ui\Container\ItemViewInterface;
use WellCart\Ui\Container\LayoutView\Root;
use WellCart\Ui\Container\PreparableContainerInterface;
use WellCart\View\Model\ViewModel;
use WellCart\View\Renderer;

class AbstractItemView extends ViewModel
    implements
    Mvc\Controller\PluginManagerAwareInterface,
    Stdlib\ResponseAwareInterface,
    Renderer\ViewRendererAwareInterface,
    PreparableContainerInterface,
    ItemViewInterface,
    BlockInterface
{
    use
        Mvc\Controller\PluginManagerAwareTrait,
        Stdlib\ResponseAwareTrait,
        Renderer\ViewRendererAwareTrait;

    protected $id;

    /**
     * @var Root
     */
    protected $rootView;
    /**
     * Is the item prepared ?
     *
     * @var bool
     */
    protected $isPrepared = false;

    protected $actionResult;

    /**
     * @return Root
     */
    public function getRootView()
    {
        return $this->rootView;
    }

    /**
     * @param Root $rootView
     *
     * @return AbstractItemView
     */
    public function setRootView(Root $rootView)
    {
        $this->rootView = $rootView;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getActionResult()
    {
        return $this->actionResult;
    }

    /**
     * @param mixed $actionResult
     *
     * @return AbstractItemView
     */
    public function setActionResult($actionResult)
    {
        $this->actionResult = $actionResult;
        return $this;
    }

    /**
     * Initialize view item variables
     *
     * @return void
     */
    public function init()
    {
        $this->getEventManager()->trigger(__FUNCTION__, $this);
    }

    /**
     * This method is called to allow the action to prepare itself.
     *
     * @param  string                  $template The script/resource process
     * @param  null|array|\ArrayAccess $values   Values to use during rendering
     *
     * @return PreparableContainerInterface
     */
    public function prepare($template = null, $values = null)
    {
        if ($this->isPrepared()) {
            return $this;
        }

        if ($template !== null) {
            $this->setTemplate($template);
        }
        if (is_array($values) && !empty($values)) {
            foreach ($values as $key => $value) {
                $this->setVariable($key, $value);
            }
        }
        $this->getEventManager()->trigger(__FUNCTION__, $this);
        $this->isPrepared = true;
        return $this;
    }

    /**
     * @return bool
     */
    public function isPrepared(): bool
    {
        return boolval($this->isPrepared);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     *
     * @return AbstractItemView
     */
    public function setId($id)
    {
        $this->id = $id;
        $this->setVariable('__BLOCK_ID__', $id);
        return $this;
    }


}