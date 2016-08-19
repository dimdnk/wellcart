<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\View\Helper;

use HtImgModule\Imagine\Filter\FilterManagerInterface;
use WellCart\Utility\Arr;
use Zend\View\Helper\AbstractHelper;

class ResizeImage extends AbstractHelper
{
    /**
     * @var FilterManagerInterface
     */
    protected $filterManager;
    protected $theme;

    /**
     * Constructor
     *
     * @param FilterManagerInterface $filterManager
     */
    public function __construct(
        FilterManagerInterface $filterManager, $theme
    ) {
        $this->filterManager = $filterManager;
        $this->theme = $theme;
    }

    /**
     * @param  string $relativeName Relative Path
     * @param  string $filterName   Filter Service
     *
     * @return ResizeImage|string
     */
    public function __invoke($relativeName = null, $filterName)
    {
        if ($relativeName === null) {
            return $this;
        }

        $filterOptions = (array)$this->filterManager->getFilterOptions(
            $filterName
        );

        $width = abs((int)Arr::get($filterOptions, 'width', 0));
        $height = abs((int)Arr::get($filterOptions, 'height', 0));
        $size = DS . $this->theme . '_' . $width . 'x' . $height;
        $imageCacheDir = $filterName . $size;

        $relativeName = str_replace(
            'original_image', $imageCacheDir, $relativeName
        );
        return $this->view->plugin('mediaPath')->__invoke($relativeName);
    }
}