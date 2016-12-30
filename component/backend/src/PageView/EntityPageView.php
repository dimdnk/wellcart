<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Backend\PageView;

use WellCart\Navigation\Pager;
use WellCart\ORM\AbstractRepository;
use WellCart\ORM\Repository;
use WellCart\Ui\Container\PageView\AbstractPageView;
use WellCart\Utility\Arr;

class EntityPageView extends AbstractPageView
{

    /**
     * Page Title
     *
     * @var string
     */
    protected $pageTitle = 'Default Page Title';

    /**
     * @var array
     */
    protected $breadcrumbs = [];
    /**
     * @var Pager
     */
    protected $pager;
    /**
     * Object Repository
     *
     * @var AbstractRepository
     */
    protected $repository;

    /**
     * Constructor
     *
     * @param  null|array|\Traversable $variables
     * @param  array|\Traversable      $options
     */
    public function __construct($variables = null, $options = null)
    {
        parent::__construct($variables, $options);
        $this->pager = new Pager();
    }

    /**
     * @return Pager
     */
    public function getPager(): Pager
    {
        return $this->pager;
    }

    /**
     * @return AbstractRepository
     */
    public function getRepository()
    {
        return $this->repository;
    }

    /**
     * Set object repository
     *
     * @param Repository $repository
     *
     * @return $this
     */
    public function setRepository(Repository $repository)
    {
        $this->repository = $repository;
        return $this;
    }

    /**
     * @return string
     */
    public function getPageTitle()
    {
        return $this->pageTitle;
    }

    /**
     * @param string $pageTitle
     *
     * @return EntityPageView
     */
    public function setPageTitle($pageTitle)
    {
        $this->pageTitle = $pageTitle;
        $this->setVariable('pageTitle', $pageTitle);
        return $this;
    }

    /**
     * Breadcrumb items
     *
     * @return array
     */
    public function getBreadcrumbs()
    {
        return $this->breadcrumbs;
    }

    /**
     * @param array $breadcrumbs
     *
     * @return EntityPageView
     */
    public function setBreadcrumbs(array $breadcrumbs)
    {
        $this->breadcrumbs = $breadcrumbs;
        return $this;
    }

    public function addBreadcrumb(array $breadcrumb)
    {
        $this->breadcrumbs = Arr::merge($this->breadcrumbs, $breadcrumb);
        return $this;
    }


    final public function getContainerClass()
    {
        return $this->getVariable('containerClass');
    }

    /**
     * @return EntityPageView
     */
    final protected function setContainerClass($cssClass)
    {
        $this->setVariable('containerClass', $cssClass);
        return $this;
    }
}
