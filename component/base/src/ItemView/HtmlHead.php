<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Base\ItemView;

use WellCart\Ui\Container\ItemView\AbstractItemView;
use Zend\View\Helper\HeadMeta;

/**
 * HtmlHead
 */
class HtmlHead extends AbstractItemView
{
    protected $csrf;

    /**
     * Template to use when rendering this model
     *
     * @var string
     */
    protected $template = 'wellcart-base/item-view/html-head';

    public function __construct(
        $variables,
        $options,
        $csrfValidator
    ) {
        parent::__construct($variables, $options);
        $this->csrf = $csrfValidator;
    }


    /**
     * Initialize view item variables
     *
     * @return void
     */
    public function init()
    {
        /**
         * @var $headMeta HeadMeta
         */
        $headMeta = $this->getView()->plugin('headmeta');

        $headMeta->setCharset('utf-8');
        $headMeta->appendName('csrf-param', 'csrf');
        $headMeta->appendName('csrf-token', $this->csrf->getHash())
            ->appendHttpEquiv('expires', 'Saturday, 03 March 2012 14:00:00 GMT')
            ->appendHttpEquiv('pragma', 'no-cache')
            ->appendHttpEquiv('Cache-Control', 'no-cache')
            ->appendName('viewport', 'width=device-width, initial-scale=1.0')
            ->appendHttpEquiv('X-UA-Compatible', 'IE=edge');
    }
}
