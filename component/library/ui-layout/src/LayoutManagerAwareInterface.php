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

interface LayoutManagerAwareInterface
{

    /**
     * @return LayoutManager
     */
    public function getLayoutManager(): LayoutManager;

    /**
     * @param LayoutManager $layoutManager
     *
     * @return LayoutManagerAwareTrait
     */
    public function setLayoutManager(LayoutManager $layoutManager);


    /**
     * Add layout handle
     *
     * @param string $handle
     * @param int    $priority
     *
     * @return mixed
     */
    public function addLayoutHandle(string $handle, int $priority = 0);

    /**
     * Remove layout handle
     *
     * @param string $handle
     *
     * @return $this
     */
    public function removeLayoutHandle(string $handle);
}