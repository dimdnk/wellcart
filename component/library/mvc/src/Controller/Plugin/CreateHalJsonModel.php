<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Mvc\Controller\Plugin;

use WellCart\View\Model\HalJsonModel;
use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class CreateHalJsonModel extends AbstractPlugin
{
    /**
     * Create view model
     *
     * @param  null|array|\Traversable $variables
     * @param  array|\Traversable      $options
     *
     * @return HalJsonModel
     */
    public function __invoke($variables = null, $options = null)
    {
        /**
         * @var $viewModel HalJsonModel
         */
        $viewModel = clone $this->getController()
            ->getServiceLocator()
            ->get('StandardHalJsonModel');

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