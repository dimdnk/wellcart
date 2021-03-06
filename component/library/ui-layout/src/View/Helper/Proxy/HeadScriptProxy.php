<?php

namespace WellCart\Ui\Layout\View\Helper\Proxy;

/**
 * @package WellCart\Ui\Layout
 
 * @codeCoverageIgnore
 */
class HeadScriptProxy extends AbstractViewHelperProxy
{

    public function appendFile($src, $type = 'text/javascript', $attrs = [])
    {
        return $this->helper->appendFile($src, $type, $attrs);
    }

    public function prependFile($src, $type = 'text/javascript', $attrs = [])
    {
        return $this->helper->prependFile($src, $type, $attrs);
    }

    public function setFile($src, $type = 'text/javascript', $attrs = [])
    {
        return $this->helper->setFile($src, $type, $attrs);
    }

    public function appendScript($script, $type = 'text/javascript', $attrs = [])
    {
        return $this->helper->appendScript($script, $type, $attrs);
    }

    public function prependScript($script, $type = 'text/javascript', $attrs = [])
    {
        return $this->helper->prependScript($script, $type, $attrs);
    }

    public function setScript($script, $type = 'text/javascript', $attrs = [])
    {
        return $this->helper->setScript($script, $type, $attrs);
    }
}
