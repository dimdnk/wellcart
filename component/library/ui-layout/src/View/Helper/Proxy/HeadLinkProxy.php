<?php

namespace WellCart\Ui\Layout\View\Helper\Proxy;

use WellCart\Ui\Layout\View\Helper\Proxy\AbstractViewHelperProxy;

/**
 * @package WellCart\Ui\Layout
 
 * @codeCoverageIgnore
 */
class HeadLinkProxy extends AbstractViewHelperProxy
{
    public function appendStylesheet($href, $media = 'screen', $condition = '', $extras = [])
    {
        return $this->helper->appendStylesheet($href, $media, $condition, $extras);
    }

    public function prependStylesheet($href, $media = 'screen', $condition = '', $extras = [])
    {
        return $this->helper->prependStylesheet($href, $media, $condition, $extras);
    }

    public function setStylesheet($href, $media = 'screen', $condition = '', $extras = [])
    {
        return $this->helper->setStylesheet($href, $media, $condition, $extras);
    }

    public function appendAlternate($href, $type, $title, $extras = [])
    {
        return $this->helper->appendAlternate($href, $type, $title, $extras);
    }

    public function prependAlternate($href, $type, $title, $extras = [])
    {
        return $this->helper->prependAlternate($href, $type, $title, $extras);
    }

    public function setAlternate($href, $type, $title, $extras = [])
    {
        return $this->helper->setAlternate($href, $type, $title, $extras);
    }
}
