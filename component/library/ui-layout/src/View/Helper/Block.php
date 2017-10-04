<?php

namespace WellCart\Ui\Layout\View\Helper;

use WellCart\Ui\Layout\Block\BlockPool;
use WellCart\Ui\Layout\Block\BlockPoolInterface;
use WellCart\Ui\Layout\Layout\LayoutInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\View\Model\ModelInterface;
use Zend\View\Model\ViewModel;

/**
 * @package WellCart\Ui\Layout
 
 */
class Block extends AbstractHelper
{
    /**
     *
     * @var LayoutInterface
     */
    private $blockPool;

    /**
     *
     * @param BlockPoolInterface $blockPool
     */
    public function __construct(BlockPoolInterface $blockPool)
    {
        $this->blockPool = $blockPool;
    }

    /**
     *
     * @param string $blockId
     * @return ModelInterface
     */
    public function __invoke($blockId)
    {
        return $this->blockPool->get($blockId);
    }
}
