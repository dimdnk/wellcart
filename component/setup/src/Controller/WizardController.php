<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Setup\Controller;

use Throwable;
use WellCart\Mvc\Controller\AbstractControllerTrait;
use WellCart\Setup\Service\Setup as SetupService;
use Wizard\WizardFactory;
use Zend\I18n\Translator\TranslatorAwareInterface;
use Zend\Log\LoggerAwareInterface;
use Zend\Mvc\Controller\AbstractActionController;

class WizardController extends AbstractActionController implements
    LoggerAwareInterface,
    TranslatorAwareInterface
{
    use AbstractControllerTrait;

    /**
     * @return array|\Zend\View\Model\ViewModel
     */
    public function processAction(SetupService $setup, WizardFactory $wizard)
    {
        /* @var $wizard \Wizard\WizardInterface */
        $wizard = $wizard->create('wellcart:setup');
        $currentStep = $wizard->getCurrentStep();
        $currentStep->setSetupService($setup);

        $this->layout()->setVariables(
            [
                'wizard'      => $wizard,
                'currentStep' => $currentStep,
                'setup'       => $setup
            ]
        );
        if ($this->getRequest()->isPost()) {
            try {
                $wizard->process();
                if ($currentStep->isComplete()) {
                    return $this->prg();
                }
            } catch (Throwable $e) {
                error_log($e->__toString());
                $this->getLogger()
                    ->emerg($e);
                $this->flashMessenger()
                    ->addWarningMessage(
                        $this->__($e->getMessage())
                    );
                return $this->prg();
            }
        }

        $locator = $this->getServiceLocator();
        $flashNotifications = $locator->get(
            'WellCart\Base\ItemView\FlashNotifications'
        );
        $notifications = $locator->get(
            'WellCart\Base\ItemView\Notifications'
        );
        $flashNotifications->setId('setup.wizard.flash_notifications');
        $notifications->setId('setup.wizard.notifications');

        return $wizard->getViewModel()
            ->addChild($flashNotifications, 'notifications', true)
            ->addChild($notifications, 'notifications', true);
    }
}
