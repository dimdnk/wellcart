<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Mvc\Controller;


use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Zend\I18n\Translator\TranslatorAwareInterface;
use Zend\Log\LoggerAwareInterface;
use Zend\Mvc\Controller\AbstractRestfulController as RestfulController;
use Zend\Mvc\MvcEvent;

/**
 * Abstract controller
 *
 * @method \WellCart\Ui\Datagrid\Controller\Plugin\GridFilterBuilder gridFilterBuilder($scope, $queryBuilder = null)
 * @method \WellCart\Mvc\Controller\Plugin\CreateViewModel createViewModel($variables = null, $options = null)
 * @method \WellCart\Mvc\Controller\Plugin\CreatePageView createPageView($variables = null, $options = null, $pageView = 'StandardPageView')
 * @method \WellCart\Mvc\Controller\Plugin\CreateConsoleModel createConsoleModel($variables = null, $options = null)
 * @method \WellCart\Mvc\Controller\Plugin\CreateFeedModel createFeedModel($variables = null, $options = null)
 * @method \WellCart\Mvc\Controller\Plugin\CreateHalJsonModel createHalJsonModel($variables = null, $options = null)
 * @method \WellCart\Mvc\Controller\Plugin\CreateImageModel createImageModel($variables = null, $options = null)
 * @method \WellCart\Mvc\Controller\Plugin\CreateJsonModel createJsonModel($variables = null, $options = null)
 * @method \WellCart\Mvc\Controller\Plugin\InvokeAction invokeAction(MvcEvent $e)
 * @method \WellCart\Mvc\Controller\Plugin\Locale locale()
 * @method \WellCart\Mvc\Controller\Plugin\Messenger messenger()
 * @method \WellCart\Mvc\Controller\Plugin\FlashMessenger flashMessenger()
 * @method \WellCart\Mvc\Controller\Plugin\Redirect redirect()
 * @method \SimpleBus\Message\Bus\Middleware\MessageBusSupportingMiddleware commandBus()
 */
abstract class AbstractRestfulController
    extends RestfulController
    implements
    LoggerAwareInterface,
    TranslatorAwareInterface,
    ObjectManagerAwareInterface
{
    use AbstractControllerTrait;
}
