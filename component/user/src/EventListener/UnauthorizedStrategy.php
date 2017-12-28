<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\User\EventListener;

use WellCart\Mvc\Application;
use WellCart\Mvc\Exception\AccessDeniedException;
use WellCart\View\Model\ViewModel;
use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventManagerInterface;
use Zend\Http\Response as HttpResponse;
use Zend\Mvc\MvcEvent;

class UnauthorizedStrategy extends AbstractListenerAggregate
{

    /**
     * {@inheritdoc}
     */
    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $this->listeners[] = $events->attach(
            MvcEvent::EVENT_DISPATCH_ERROR,
            [$this, 'onError'],
            -50
        );
    }

    /**
     * Log standard exception
     *
     * @param MvcEvent $e
     */
    public function onError(MvcEvent $e)
    {
        $error = $e->getError();
        if ($error == Application::ERROR_EXCEPTION) {
            $exception = $e->getParam('exception');
            if ($exception instanceof AccessDeniedException) {
                $this->forbidden($e);
            }
        }
    }

    private function forbidden(MvcEvent $event)
    {
        $model = new ViewModel();
        $model->setTemplate('error/403');
        $response = $event->getResponse() ?: new HttpResponse();
        $response->setStatusCode(403);

        $event->setResponse($response);
        $event->setResult($model);
    }
}
