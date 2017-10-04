<?php

namespace WellCart\Ui\Layout\View\Helper\Proxy;

/**
 * @package WellCart\Ui\Layout
 
 * @codeCoverageIgnore
 */
class HeadTitleProxy extends AbstractViewHelperProxy
{
    public function append($value)
    {
        return $this->helper->append($value);
    }

    public function prepend($value)
    {
        return $this->helper->prepend($value);
    }

    public function set($value)
    {
        return $this->helper->set($value);
    }

    public function setSeparator($separator)
    {
        return $this->helper->setSeparator($separator);
    }
}
