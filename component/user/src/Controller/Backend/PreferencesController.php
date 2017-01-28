<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\User\Controller\Backend;

use WellCart\Base\Service\ConfigurationEditor;
use WellCart\Mvc\Controller\AbstractActionController;
use WellCart\Mvc\Controller\Feature\Crud\ActionGrantedTrait;
use WellCart\User\Form\AccountPreferences;
use WellCart\User\PageView\Backend\PreferencesForm;
use Zend\Http\PhpEnvironment\Request;

class PreferencesController extends AbstractActionController
{

    use ActionGrantedTrait;

    /**
     * @var ConfigurationEditor
     */
    protected $configEditor;

    /**
     * @var AccountPreferences
     */
    protected $form;

    /**
     * @var PreferencesForm
     */
    protected $formPageView;

    /**
     * Constructor
     *
     * @param ConfigurationEditor $editor
     */
    public function __construct(
        ConfigurationEditor $editor,
        AccountPreferences $form,
        PreferencesForm $formPageView
    ) {
        parent::__construct();
        $this->configEditor = $editor;
        $this->form = $form;
        $this->formPageView = $formPageView;
    }

    /**
     * Manage setting page
     *
     * @return \Zend\View\Model\ViewModel
     */

    public function updateAction()
    {
        $form = $this->form;
        $pageView = $this->formPageView
            ->setForm($form)->prepare();

        /**
         * @var $request Request
         */
        $request = $this->getRequest();
        if ($request->isPost()) {
            try {
                $data = $request->getPost($form->getName(), []);
                $form->setData($data);
                if ($form->isValid()) {
                    $set = $form->getData();
                    foreach ($set as $key => $_val) {
                        $context = $form->get($key)->getOption('context');
                        if ($context) {
                            $set[$key] = ['config_value' => $_val,
                                          'context'      => $context];
                        }
                    }
                    /**
                     * Save config values
                     */
                    $this->configEditor->saveConfigSet($set);

                    $this->flashMessenger()
                        ->addSuccessMessage(
                            'Settings have been successfully changed.'
                        );
                }
            } catch (\Throwable $e) {
                $this->getLogger()->emerg($e->getMessage());
                $this->flashMessenger()
                    ->addWarningMessage(
                        $this->__(
                            'An unexpected error occurred. Please try again or contact Customer Support.'
                        )
                    );
            }

            return $this->redirect()->refresh();
        }

        return $pageView->prepare();
    }

    /**
     * @inheritdoc
     */
    protected function preDispatch($mvcEvent)
    {
        $permission = 'user/preferences/view';
        $this->isGrantedOrDeny($permission);
    }
}
