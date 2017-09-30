<?php

namespace  WellCart\Ui\Theme\Adapter;

/**
 * Theme adapter that returns the name of the theme specified in the configuration file based on the matched route
 */
class Route extends AbstractAdapter
{

    public function getTheme()
    {
        $config = $this->serviceLocator->get('Configuration');
        $app = $this->serviceLocator->get('Application');
        $request = $app->getRequest();
        $router = $this->serviceLocator->get('Router');
        if(!$router->match($request)){
            return null;
        }
        $matchedRoute = $router->match($request)->getMatchedRouteName();
        if (!isset($config['wellcart']['theme']['routes']) || !is_array($config['wellcart']['theme']['routes'])){
            return null;
        }
        foreach($config['wellcart']['theme']['routes'] as $key=>$routes){
            if (in_array($matchedRoute, $routes)){
                return $key;
            }
        }
        return null;
    }

}