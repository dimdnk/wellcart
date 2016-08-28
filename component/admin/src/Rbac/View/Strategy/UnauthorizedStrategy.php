<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Admin\Rbac\View\Strategy;

use ConLayout\Updater\LayoutUpdaterInterface;
use WellCart\Mvc\Application;
use WellCart\Mvc\Controller\PluginManagerAwareInterface;
use WellCart\Mvc\Controller\PluginManagerAwareTrait;
use WellCart\Stdlib\RequestAwareInterface;
use WellCart\Stdlib\RequestAwareTrait;
use WellCart\View\Model\ViewModel;
use Zend\EventManager\EventInterface as Event;
use Zend\Http\Response as HttpResponse;
use Zend\Mvc\InjectApplicationEventInterface;
use Zend\Mvc\MvcEvent;
use Zend\Stdlib;
use ZfcRbac\Exception\UnauthorizedExceptionInterface;
use ZfcRbac\Options\UnauthorizedStrategyOptions;
use ZfcRbac\View\Strategy\UnauthorizedStrategy as Strategy;

class UnauthorizedStrategy extends Strategy implements
    PluginManagerAwareInterface,
    InjectApplicationEventInterface,
    Stdlib\DispatchableInterface,
    RequestAwareInterface
{

    use PluginManagerAwareTrait,
        RequestAwareTrait;

    /**
     * @var Event
     */
    protected $event;
    protected $layoutUpdater;

    /**
     * UnauthorizedStrategy constructor.
     *
     * @param UnauthorizedStrategyOptions $options
     * @param LayoutUpdaterInterface      $layoutUpdater
     */
    public function __construct(
        UnauthorizedStrategyOptions $options,
        LayoutUpdaterInterface $layoutUpdater)
    {
        parent::__construct($options);
        $this->layoutUpdater = $layoutUpdater;
    }


    /**
     * @private
     *
     * @param  MvcEvent $event
     *
     * @return void
     */
    public function onError(MvcEvent $event)
    {
        $matched = $event->getRouteMatch();
        if (!$matched) {
            return;
        }
        $routeName = $matched->getMatchedRouteName();
        if (strlen($routeName) < 8 || substr($routeName, 0, 8) != 'zfcadmin'
        ) {
            return;
        }

        // Do nothing if no error or if response is not HTTP response
        if (!($event->getParam('exception') instanceof
                UnauthorizedExceptionInterface)
            || ($event->getResult() instanceof HttpResponse)
            || !($event->getResponse() instanceof HttpResponse)
        ) {
            return;
        }

        $this->setEvent($event);

        $layout = $this->getControllerPlugin('layout');
        $layoutUpdater = $this->layoutUpdater;

        $layout->setController($this);
        $forward = $this->getControllerPlugin('forward');
        $forward->setController($this);

        $area = Application::CONTEXT_BACKEND . '/unauthorized';
        $layoutUpdater->setArea($area);

        $layout->setTemplate('layout/empty');

        $result = $forward->dispatch(
            'WellCart\Admin\Controller\Login',
            ['action' => 'login']
        );

        if ($result instanceof ViewModel) {
            $response = $event->getResponse() ?: new HttpResponse();
            $response->setStatusCode(403);
            $event->setResponse($response);
        }

        $event->setResult($result);
    }

    /**
     * Get the attached event
     *
     * Will create a new MvcEvent if none provided.
     *
     * @return MvcEvent
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Set an event to use during dispatch
     *
     * By default, will re-cast to MvcEvent if another event type is provided.
     *
     * @param  Event $e
     *
     * @return void
     */
    public function setEvent(Event $e)
    {
        $this->event = $e;
    }

    /**
     * Dispatch a request
     *
     * @param RequestInterface       $request
     * @param null|ResponseInterface $response
     *
     * @return Response|mixed
     */
    public function dispatch(
        Stdlib\RequestInterface $request,
        Stdlib\ResponseInterface $response = null
    ) {
    }
}
