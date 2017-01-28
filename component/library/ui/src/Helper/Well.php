<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\Ui\Helper;

use Zend\View\Helper\AbstractHelper;

/**
 * Well view helper
 *
 */
class Well extends AbstractHelper
{

    protected $format = '<div class="well%s">%s</div>';

    /**
     * @param string $content
     * @param string $class
     *
     * @return Well|string
     */
    public function __invoke($content = '', $class = '')
    {
        if ($content) {
            return $this->render($content, $class);
        }

        return $this;
    }

    public function render($content, $class = '')
    {
        if (!empty($class)) {
            $class = ' ' . trim($class);
        }

        return sprintf($this->format, $class, $content);
    }

    public function large($content)
    {
        return $this->render($content, 'well-lg');
    }

    public function small($content)
    {
        return $this->render($content, 'well-sm');
    }
}