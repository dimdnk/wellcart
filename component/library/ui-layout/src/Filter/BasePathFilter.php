<?php
namespace WellCart\Ui\Layout\Filter;

use Zend\Filter\FilterInterface;
use Zend\View\Helper\BasePath as BasePathHelper;

/**
 * @package WellCart\Ui\Layout
 
 */
class BasePathFilter implements FilterInterface
{
    /**
     *
     * @var BasePathHelper $basePathHelper
     */
    protected $basePathHelper;

    /**
     *
     * @param BasePathHelper $basePathHelper
     */
    public function __construct(BasePathHelper $basePathHelper)
    {
        $this->basePathHelper = $basePathHelper;
    }

    /**
     *
     * @param string $value asset url to prepare
     * @return string prepared asset url
     */
    public function filter($value)
    {
        $urlHost = parse_url($value, PHP_URL_HOST);
        if (empty($urlHost)) {
            return call_user_func($this->basePathHelper, $value);
        }
        return $value;
    }
}
