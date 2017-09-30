<?php
namespace  WellCart\Ui\Theme\Adapter;

/**
 * Theme adapter that returns the name of the theme specified in the configuration file
 */
class Configuration extends AbstractAdapter
{

    public function getTheme()
    {
        $config = $this->serviceLocator->get('Configuration');
        if (!isset($config['wellcart']['theme']['default_theme'])){
            return null;
        }
        return $config['wellcart']['theme']['default_theme'];
    }

}