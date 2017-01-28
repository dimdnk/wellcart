<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\Ui\Datagrid\View\Helper\GridFilter;

use WellCart\Utility\Arr;
use WellCart\Utility\Collection;
use Zend\Mvc\Controller\Plugin\Url;
use Zend\Stdlib\RequestInterface;

class Sorter
    extends Collection
{

    /**
     * @var \Zend\Http\PhpEnvironment\Request
     */
    protected $request;

    protected $urlPlugin;

    /**
     * @var array
     */
    protected $defaultOrder = ['sortBy' => 'id', 'sortOrder' => 'asc'];

    /**
     * Constructor.
     *
     * @param array            $items
     * @param RequestInterface $request
     * @param Url              $urlPlugin
     */
    public function __construct(
        array $items = [],
        RequestInterface $request,
        Url $urlPlugin
    ) {
        parent::__construct($items);
        $this->request = $request;
        $this->urlPlugin = $urlPlugin;
    }

    /**
     * @return array
     */
    public function getDefaultOrder()
    {
        return $this->defaultOrder;
    }

    /**
     * @param        $sortBy
     * @param string $sortOrder
     *
     * @return Sorter
     */
    public function setDefaultOrder($sortBy, $sortOrder = 'asc')
    {
        $this->defaultOrder = [
            'sortBy'    => $sortBy,
            'sortOrder' => $sortOrder,
        ];

        return $this;
    }

    /**
     * Returns sorter link
     *
     * @param $column
     * @param $label
     *
     * @return string
     */
    public function link($column, $label)
    {
        if (!$this->offsetExists($column)) {
            return $label;
        }

        $sortOrder = strtolower(
            Arr::get($_GET, 'sortOrder', $this->defaultOrder['sortOrder'])
        );

        $params = $this->request->getQuery();
        $params['sortBy'] = $column;


        $currentSortBy = Arr::get($_GET, 'sortBy');
        if ($column == $currentSortBy) {
            $params['sortOrder'] = ($sortOrder == 'asc') ? 'desc' : 'asc';
        } else {
            $params['sortOrder'] = $this->defaultOrder['sortOrder'];
        }

        $querySuffix = '?' . http_build_query($params->toArray(), '', '&amp;');
        $chevron = '';
        if ($column == $currentSortBy) {
            $chevron
                = ' <i class="fa fa-angle-%s"></i>';
            $icon = 'down';
            if ($sortOrder == 'desc') {
                $icon = 'up';
            }
            $chevron = sprintf($chevron, $icon);
        }
        $url = $this->urlPlugin->fromRoute(null, [], [], true) . $querySuffix;

        return '<a href="' . $url . '">' . $label . ' &nbsp; ' . $chevron
            . '</a>';
    }

    /**
     * Assigns a value to the specified offset.
     *
     * @access  public
     *
     * @param   mixed $offset The offset to assign the value to
     * @param   mixed $value  The value to set
     */
    public function set($offset, $value)
    {
        return $this->offsetSet($offset, $value);
    }

    /**
     * @return Sorter
     */
    public function __invoke()
    {
        return $this;
    }
}