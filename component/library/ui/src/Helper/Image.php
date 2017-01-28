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
 * Image view helper
 */
class Image extends AbstractHelper
{

    protected $format = '<img src="%s"%s>';

    protected $isResponsive = true;

    public function rounded($src)
    {
        return $this->render($src, 'img-rounded');
    }

    public function render($src, $class = '')
    {
        $basePath = $this->view->plugin('basePath');
        $class = trim($class);

        if ($this->isResponsive) {
            if (!empty($class)) {
                $class .= ' ';
            }
            $class .= 'img-responsive';
        }

        return sprintf(
            $this->format,
            strpos($src, 'http') === 0 ? $src : $basePath($src),
            !empty($class) ? " class=\"$class\"" : ''
        );
    }

    public function circle($src)
    {
        return $this->render($src, 'img-circle');
    }

    public function thumbnail($src)
    {
        return $this->render($src, 'img-thumbnail');
    }

    public function setResponsive($responsive)
    {
        if (!is_bool($responsive)) {
            throw new \InvalidArgumentException(
                "Argument must be a bool value."
            );
        }

        $this->isResponsive = $responsive;

        return $this;
    }

    public function __invoke($src = '', $class = '')
    {
        if ($src) {
            return $this->render($src, $class);
        }

        return $this;
    }
}