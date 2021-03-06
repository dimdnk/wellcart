<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\Ui\Layout;

use WellCart\Ui\Layout\Controller\Plugin\LayoutManager;
use WellCart\Ui\Layout\Handle\Handle;

trait LayoutManagerAwareTrait
{

    /**
     * @var LayoutManager
     */
    protected $layoutManager;

    /**
     * Add layout handle
     *
     * @param string $handle
     * @param int    $priority
     *
     * @return mixed
     */
    public function addLayoutHandle(string $handle, int $priority = 0)
    {
        $this->getLayoutManager()->addHandle(new Handle($handle, $priority));

        return $this;
    }

    /**
     * @return LayoutManager
     */
    public function getLayoutManager(): LayoutManager
    {
        return $this->layoutManager;
    }

    /**
     * @param LayoutManager $layoutManager
     *
     * @return LayoutManagerAwareTrait
     */
    public function setLayoutManager(LayoutManager $layoutManager)
    {
        $this->layoutManager = $layoutManager;

        return $this;
    }

    /**
     * Remove layout handle
     *
     * @param string $handle
     *
     * @return $this
     */
    public function removeLayoutHandle(string $handle)
    {
        $this->getLayoutManager()->removeHandle($handle);

        return $this;
    }
}