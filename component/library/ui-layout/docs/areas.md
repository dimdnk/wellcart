# Areas

With areas you can tell the layout updater which layout updates to fetch.
E.g. frontend, backend etc.

Before you can use this feature, you have to tell the layout updater
in which area we are currently in.


````php
<?php
// determine area.
$area = $this->determineArea(); // 'frontend' or 'backend' or 'admin' ...

/* @var $layoutUpdater \WellCart\Ui\Layout\Updater\LayoutUpdaterInterface */
$layoutUpdater = $sm->get('WellCart\Ui\Layout\Updater\LayoutUpdaterInterface');
$layoutUpdater->setArea($area);

````

Now you could add the paths for the areas in some module configuration:

````php
<?php
// module.config.php in Application module
return [
   'wellcart' => [
    // ...
        'layout' => [
            'layout_update_paths' => [
                'frontend' => [
                    __DIR__ . '/../layout/frontend'
                ],
                'backend' => [
                    __DIR__ . '/../layout/backend'
                ]
            ]
        ]
    // ...
    ]
];
````

### How to determine the current area?

A possible implementation could be to listen to the MVC dispatch event
and determine the area by the matched route name:


````php
<?php

namespace Application\Listener;

use WellCart\Ui\Layout\Updater\LayoutUpdaterInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\ListenerAggregateTrait;
use Zend\Mvc\MvcEvent;

class AreaListener implements ListenerAggregateInterface
{
    use ListenerAggregateTrait;

    const AREA_BACKEND  = 'backend';

    /**
     * @var LayoutUpdaterInterface
     */
    protected $layoutUpdater;

    public function __construct(LayoutUpdaterInterface $layoutUpdateListener)
    {
        $this->layoutUpdater = $layoutUpdater;
    }

    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $events->attach(MvcEvent::EVENT_DISPATCH, [$this, 'onDispatch']);
    }

    public function onDispatch(MvcEvent $e)
    {
        $area = LayoutUpdaterInterface::AREA_DEFAULT;

        $routeMatch = $e->getRouteMatch();
        $matchedRouteName = $routeMatch->getMatchedRouteName();

        // example for zfc admin
        if (fnmatch('backend*', $matchedRouteName)) {
            $area = self::AREA_BACKEND;
        }

        $this->layoutUpdater->setArea($area);
    }
}
````
