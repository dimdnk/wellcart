<?php
/**
 * @package

 */

namespace WellCart\Ui\Layout\Block;

use Zend\View\Model\ModelInterface;

interface BlockPoolInterface
{
    /**
     * @param string|null $blockId
     * @return ModelInterface|BlockInterface|false
     */
    public function get($blockId = null);

    /**
     * @param string $blockId
     * @param ModelInterface $block
     * @return mixed
     */
    public function add($blockId, ModelInterface $block);

    /**
     * @param string $blockId
     * @return mixed
     */
    public function remove($blockId);

    /**
     * @return mixed
     */
    public function sort();
}
