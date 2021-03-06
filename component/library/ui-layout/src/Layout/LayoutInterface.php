<?php

namespace WellCart\Ui\Layout\Layout;

use WellCart\Ui\Layout\Generator\GeneratorInterface;
use Zend\View\Model\ModelInterface;

/**
 * @package WellCart\Ui\Layout
 
 */
interface LayoutInterface
{
    /**
     * block id of root view model
     */
    const BLOCK_ID_ROOT = 'root';

    /**
     * block id of view model returned by controller
     */
    const BLOCK_ID_ACTION_RESULT = 'action.result';

    /**
     * delimiter block_id::cpature_to
     */
    const CAPTURE_TO_DELIMITER = '::';

    /**
     * retrieve single block by block id
     *
     * @param string $blockId
     * @return ModelInterface
     */
    public function getBlock($blockId);

    /**
     * retrieve all blocks
     *
     * @return ModelInterface[]
     */
    public function getBlocks();

    /**
     * add a single block
     *
     * @param string $blockId
     * @param ModelInterface $block
     */
    public function addBlock($blockId, ModelInterface $block);

    /**
     * removes a single block
     *
     * @param string $blockId
     */
    public function removeBlock($blockId);

    /**
     * @param array $generators load only given generators or all if empty
     * @return mixed
     */
    public function generate(array $generators = []);

    /**
     * inject blocks/build view model tree
     *
     * @return mixed
     */
    public function injectBlocks();

    /**
     * load the layout
     */
    public function load();

    /**
     * set root view model/layout
     *
     * @param ModelInterface $root
     */
    public function setRoot(ModelInterface $root);

    /**
     * @param string $name
     * @param GeneratorInterface $generator
     * @param int $priority
     * @return mixed
     */
    public function attachGenerator($name, GeneratorInterface $generator, $priority = 1);

    /**
     * removes a generator
     *
     * @param string $name
     * @return mixed
     */
    public function detachGenerator($name);
}
