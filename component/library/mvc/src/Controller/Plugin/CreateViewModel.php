<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\Mvc\Controller\Plugin;

use WellCart\View\Model\ViewModel;
use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class CreateViewModel extends AbstractPlugin
{

    /**
     * Create view model
     *
     * @param  null|array|\Traversable $variables
     * @param  array|\Traversable      $options
     *
     * @return ViewModel
     */
    public function __invoke($variables = null, $options = null)
    {
        /**
         * @var $viewModel ViewModel
         */
        $viewModel = clone $this->getController()->getServiceLocator()->get(
            'StandardViewModel'
        );
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