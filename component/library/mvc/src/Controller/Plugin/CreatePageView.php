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

class CreatePageView extends AbstractPlugin
{

    public function __invoke(array $variables = null, array $options = null,
        $pageView = 'StandardPageView'
    ) {
        $viewModel = $this->getController()
            ->getServiceLocator()
            ->get(
                $pageView
            );

        if (null !== $variables) {
            $viewModel->setVariables($variables, true);
        }

        if (null !== $options) {
            $viewModel->setOptions($options);
        }

        return $viewModel;
    }
}