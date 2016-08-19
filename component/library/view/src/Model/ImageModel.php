<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\View\Model;

use HtImgModule\View\Model\ImageModel as Model;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerAwareTrait;

class ImageModel extends Model implements
    EventManagerAwareInterface
{
    use EventManagerAwareTrait;

    /**
     * Constructor
     *
     * @param  ImageInterface|string $imageOrPath
     * @param  string|null           $format
     * @param  array                 $imageOutputOptions
     *
     * @throws Exception\InvalidArgumentException
     */
    public function __construct($imageOrPath = null, $format = null,
        array $imageOutputOptions = []
    ) {
        parent::__construct($imageOrPath, $format, $imageOutputOptions);
        $this->setVariable('context', $this);
    }
}