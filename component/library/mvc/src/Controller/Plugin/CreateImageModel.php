<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Mvc\Controller\Plugin;

use WellCart\View\Model\ImageModel;
use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class CreateImageModel extends AbstractPlugin
{
    /**
     * Create view model
     *
     * @param  null|array|\Traversable $variables
     * @param  array|\Traversable      $options
     *
     * @return ImageModel
     */
    public function __invoke($variables = null, $options = null)
    {
        /**
         * @var $viewModel ImageModel
         */
        $viewModel = clone $this->getController()
            ->getServiceLocator()
            ->get('StandardImageModel');

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