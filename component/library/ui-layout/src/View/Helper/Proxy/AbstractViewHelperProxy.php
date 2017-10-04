<?php

namespace WellCart\Ui\Layout\View\Helper\Proxy;

use Zend\View\Helper\AbstractHelper;
use Zend\View\Helper\HelperInterface;

/**
 * @package WellCart\Ui\Layout
 
 */
abstract class AbstractViewHelperProxy extends AbstractHelper
{
    /**
     *
     * @var HelperInterface
     */
    protected $helper;

    /**
     *
     * @param HelperInterface $helper
     */
    public function __construct(HelperInterface $helper)
    {
        $this->helper = $helper;
    }

    public function __call($name, $arguments)
    {
        return call_user_func_array([$this->helper, $name], $arguments);
    }
}
