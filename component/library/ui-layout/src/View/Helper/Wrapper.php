<?php

namespace WellCart\Ui\Layout\View\Helper;

use Zend\View\Helper\AbstractHtmlElement;

/**
 * @package WellCart\Ui\Layout
 
 */
class Wrapper extends AbstractHtmlElement
{
    const DEFAULT_TAG = 'div';

    /**
     *
     * @var string
     */
    protected $tag;

    /**
     *
     * @param string $tag
     * @return Wrapper
     */
    public function __invoke($tag = null)
    {
        $this->tag = $tag ?: static::DEFAULT_TAG;
        return $this;
    }

    /**
     *
     * @param mixed $attributes
     * @return string
     */
    public function openTag($attributes = [])
    {
        $htmlAttribs = '';
        if (count($attributes)) {
            $htmlAttribs = $this->htmlAttribs($attributes);
        }
        return sprintf(
            '<%s%s>',
            $this->tag,
            $htmlAttribs
        );
    }

    /**
     *
     * @return string
     */
    public function closeTag()
    {
        return '</' . $this->tag . '>';
    }
}
