<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Mvc\Controller\Plugin;

use ReflectionClass;
use WellCart\Mvc\Exception;
use WellCart\ServiceManager\ServiceLocatorAwareInterface;
use WellCart\ServiceManager\ServiceLocatorAwareTrait;
use Zend\Mvc\Controller\AbstractController as Controller;
use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\Mvc\MvcEvent;

class InvokeAction extends AbstractPlugin
    implements ServiceLocatorAwareInterface
{

    use ServiceLocatorAwareTrait;

    public function __invoke(MvcEvent $e)
    {
        $routeMatch = $e->getRouteMatch();
        if (!$routeMatch) {
            throw new Exception\DomainException(
                'Missing route matches; unsure how to retrieve action'
            );
        }

        $controller = $this->getController();
        $action = $routeMatch->getParam('action', 'not-found');
        $method = Controller::getMethodFromAction($action);

        if (!method_exists($controller, $method)) {
            $method = 'notFoundAction';
        }

        $dependencies = $this->getActionDependencies($controller, $method);
        $actionResponse = call_user_func_array(
            [$controller, $method],
            $dependencies
        );

        $e->setResult($actionResponse);

        return $actionResponse;
    }

    protected function getActionDependencies(Controller $controller, $method
    ): array {
        $dependencies = [];
        $class = new ReflectionClass($controller);
        $method = $class->getMethod($method);
        $params = $method->getParameters();
        if (empty($params)) {
            return $dependencies;
        }
        foreach ($params as $param) {
            $key = $param->getName();
            $dependency = $param->getClass()->getName();
            $dependencies[$key] = $this->serviceLocator
                ->get($dependency);
        }

        return $dependencies;
    }
}