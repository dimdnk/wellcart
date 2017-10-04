<?php
namespace WellCart\Ui\Layout\Block;

use Zend\Http\Request;
use Zend\View\Helper\HelperInterface;
use Zend\View\Model\ModelInterface;

/**
 * @package WellCart\Ui\Layout
 
 */
interface BlockInterface extends ModelInterface, HelperInterface
{
    /**
     *
     * @param Request $request
     */
    public function setRequest(Request $request);

    /**
     *
     * @return Request
     */
    public function getRequest();
}
