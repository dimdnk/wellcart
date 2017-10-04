<?php

namespace WellCart\Ui\Layout\Block\Factory;

use WellCart\Ui\Layout\Block\BlockInterface;
use Zend\View\Model\ModelInterface;

/**
 * @package WellCart\Ui\Layout

 */
interface BlockFactoryInterface
{
    /**
     *
     * @param string $blockId
     * @param array $specs
     * @return ModelInterface|BlockInterface
     */
    public function createBlock($blockId, array $specs);

    /**
     * @param ModelInterface $block
     * @param array $specs
     * @return mixed
     */
    public function configure(ModelInterface $block, array $specs);
}
