<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);
namespace WellCart\Mvc\Controller;

use DoctrineModule\Persistence\ProvidesObjectManager;
use Zend\I18n\Translator\TranslatorAwareTrait;
use Zend\Log\LoggerAwareTrait;
use Zend\Mvc\Controller\AbstractRestfulController as RestfulController;
use Zend\Mvc\MvcEvent;

trait AbstractControllerTrait
{

    use TranslatorAwareTrait,
        LoggerAwareTrait,
        ProvidesObjectManager;

    /**
     * Constructor
     *
     */
    public function __construct()
    {
    }

    /**
     * Translate a message.
     *
     * @param  string $message
     * @param  string $textDomain
     * @param  string $locale
     *
     * @return string
     */
    public function __($message, $textDomain = 'default', $locale = null)
    {
        return $this->translator->translate($message, $textDomain, $locale);
    }

    /**
     * Execute the request
     *
     * @param  MvcEvent $e
     *
     * @return mixed
     */
    public function onDispatch(MvcEvent $e)
    {
        $layout = $this->layout();
        if (!$layout->getView()) {
            $layout->setView(
                $this->getServiceLocator()
                    ->get('ViewRenderer')
            );
        }
        $preResult = $this->preDispatch($e);
        if ($preResult !== null) {
            $e->setResult($preResult);

            return $preResult;
        }

        if ($this instanceof RestfulController) {
            $result = parent::onDispatch($e);
        } else {
            $result = $this->invokeAction($e);
        }

        $postResult = $this->postDispatch($e);
        if ($postResult !== null) {
            $e->setResult($postResult);

            return $postResult;
        }

        $layout->prepare();

        return $result;
    }

    /**
     * Pre-request action
     *
     * @param  $mvcEvent
     *
     * @return void
     */
    protected function preDispatch($mvcEvent)
    {

    }

    /**
     * Post-request action
     *
     * @param  MvcEvent $mvcEvent
     *
     * @return void
     */
    protected function postDispatch($mvcEvent)
    {

    }
}
