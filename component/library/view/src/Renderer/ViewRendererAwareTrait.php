<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\View\Renderer;

use Zend\View\Renderer\RendererInterface;

trait ViewRendererAwareTrait
{

    /**
     * @var RendererInterface
     */
    protected $view;

    /**
     * @inheritDoc
     */
    public function getView()
    {
        return $this->view;
    }

    public function setView(RendererInterface $view)
    {
        $this->view = $view;

        return $this;
    }
}