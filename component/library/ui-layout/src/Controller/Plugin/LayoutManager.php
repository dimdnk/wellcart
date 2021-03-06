<?php
namespace WellCart\Ui\Layout\Controller\Plugin;

use WellCart\Ui\Layout\Block\BlockPoolInterface;
use WellCart\Ui\Layout\Generator\GeneratorInterface;
use WellCart\Ui\Layout\Handle\Handle;
use WellCart\Ui\Layout\Handle\HandleInterface;
use WellCart\Ui\Layout\Layout\LayoutInterface;
use WellCart\Ui\Layout\Updater\LayoutUpdaterInterface;
use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\View\Model\ModelInterface;

/**
 * @package WellCart\Ui\Layout
 
 */
class LayoutManager extends AbstractPlugin implements
    LayoutInterface,
    LayoutUpdaterInterface
{
    /**
     *
     * @var LayoutInterface
     */
    protected $layout;

    /**
     *
     * @var LayoutUpdaterInterface
     */
    protected $updater;

    /**
     * @var BlockPoolInterface
     */
    protected $blockPool;

    /**
     *
     * @param LayoutInterface $layout
     * @param LayoutUpdaterInterface $updater
     * @param BlockPoolInterface $blockPool
     */
    public function __construct(
        LayoutInterface $layout,
        LayoutUpdaterInterface $updater,
        BlockPoolInterface $blockPool
    ) {
        $this->layout = $layout;
        $this->updater = $updater;
        $this->blockPool = $blockPool;
    }

    /**
     *
     * @return mixed
     */
    public function __invoke()
    {
        return $this;
    }

    /**
     *
     * @param string $blockId
     * @return ModelInterface
     */
    public function getBlock($blockId)
    {
        return $this->blockPool->get($blockId);
    }

    /**
     *
     * @param string $blockId
     * @param ModelInterface $block
     * @return LayoutManager
     */
    public function addBlock($blockId, ModelInterface $block)
    {
        $this->blockPool->add($blockId, $block);
        return $this;
    }

    /**
     *
     * @param string $blockId
     * @return LayoutManager
     */
    public function removeBlock($blockId)
    {
        $this->blockPool->remove($blockId);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getLayoutStructure()
    {
        return $this->updater->getLayoutStructure();
    }

    /**
     * @inheritDoc
     */
    public function addHandle(HandleInterface $handle)
    {
        $this->updater->addHandle($handle);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setArea($area)
    {
        $this->updater->setArea($area);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getArea()
    {
        return $this->updater->getArea();
    }

    /**
     *
     * @param array $handles
     * @return LayoutManager
     */
    public function setHandles(array $handles)
    {
        $newHandles = [];
        foreach ($handles as $handle => $priority) {
            if (is_string($handle) && !$priority instanceof HandleInterface) {
                $handle = new Handle($handle, $priority);
            } elseif ($priority instanceof HandleInterface) {
                $handle = $priority;
            }
            $newHandles[] = $handle;
        }
        $this->updater->setHandles($newHandles);
        return $this;
    }

    public function getHandles($asObject = false)
    {
        return $this->updater->getHandles($asObject);
    }

    /**
     *
     * @param string $handle
     * @return LayoutManager
     */
    public function removeHandle($handle)
    {
        $this->updater->removeHandle($handle);
        return $this;
    }

    /**
     *
     * @return ModelInterface[]
     */
    public function getBlocks()
    {
        return $this->blockPool->get();
    }

    /**
     *
     * @return LayoutManager
     */
    public function load()
    {
        $this->layout->load();
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getRoot()
    {
        return $this->layout->getRoot();
    }

    /**
     * @inheritDoc
     */
    public function setRoot(ModelInterface $root)
    {
        $this->layout->setRoot($root);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function injectBlocks()
    {
        $this->layout->injectBlocks();
    }

    /**
     * @inheritDoc
     */
    public function attachGenerator($name, GeneratorInterface $generator, $priority = 1)
    {
        $this->layout->attachGenerator($name, $generator, $priority);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function detachGenerator($name)
    {
        $this->layout->detachGenerator($name);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function generate(array $generators = [])
    {
        $this->layout->generate($generators);
        return $this;
    }
}
