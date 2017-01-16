<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);
namespace WellCart\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\View\Model\FeedModel;

class CreateFeedModel extends AbstractPlugin
{

    /**
     * Create view model
     *
     * @param  null|array|\Traversable $variables
     * @param  array|\Traversable      $options
     *
     * @return FeedModel
     */
    public function __invoke($variables = null, $options = null)
    {
        /**
         * @var $viewModel FeedModel
         */
        $viewModel = clone $this->getController()
            ->getServiceLocator()
            ->get('StandardFeedModel');

        $viewModel->clearChildren()
            ->clearVariables()
            ->clearOptions();

        if (null !== $variables) {
            $viewModel->setVariables($variables, true);
        }

        if (null !== $options) {
            $viewModel->setOptions($options);
        }

        return $viewModel;
    }
}