<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Mvc\Controller\Plugin;

use WellCart\View\Model\JsonModel;
use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class CreateJsonModel extends AbstractPlugin
{
    /**
     * Create view model
     *
     * @param  null|array|\Traversable $variables
     * @param  array|\Traversable      $options
     *
     * @return JsonModel
     */
    public function __invoke($variables = null, $options = null)
    {
        /**
         * @var $viewModel JsonModel
         */
        $viewModel = clone $this->getController()
            ->getServiceLocator()
            ->get('StandardJsonModel');

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