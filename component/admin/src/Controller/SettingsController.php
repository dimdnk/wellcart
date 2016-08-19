<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Admin\Controller;

use WellCart\Base\Service\ConfigurationEditor;
use WellCart\Mvc\Controller\AbstractActionController;
use WellCart\Mvc\Controller\Feature\Crud\ActionGrantedTrait;
use WellCart\Utility\Arr;
use Zend\Http\PhpEnvironment\Request;

class SettingsController extends AbstractActionController
{
    use ActionGrantedTrait;

    /**
     * @var ConfigurationEditor
     */
    protected $configEditor;

    /**
     * Constructor
     *
     * @param ConfigurationEditor $editor
     */
    public function __construct(
        ConfigurationEditor $editor
    ) {
        parent::__construct();
        $this->configEditor = $editor;
    }

    /**
     * Manage setting page
     *
     * @return \Zend\View\Model\ViewModel
     */
    public function updateAction()
    {
        $section = $this->params()->fromRoute('section');
        $panels = $this->configEditor->getFieldsetsSpecification($section);
        $form = $this->configEditor->composeForm($section);

        /**
         * @var $request Request
         */
        $request = $this->getRequest();
        if ($request->isPost()) {
            try {
                $data = $request->getPost($form->getName(), []);
                $form->setData($data);
                if ($form->isValid()) {
                    $set = [];
                    foreach (array_keys($panels->toArray()) as $fieldset) {
                        $values = Arr::get($data, $fieldset, []);
                        foreach ($values as $key => $value) {
                            if (is_scalar($value)) {
                                $set[$key] = $value;
                            }
                        }
                    }
                    /**
                     * Save config values
                     */
                    $this->configEditor->saveConfigSet($set);

                    $this->flashMessenger()
                        ->addSuccessMessage(
                            'The settings have been successfully updated.'
                        );

                    return $this->redirect()->refresh();
                }
            } catch (\Throwable $e) {
                $this->getLogger()->emerg($e);
                $this->flashMessenger()
                    ->addWarningMessage(
                        $this->__(
                            'An unexpected error occurred. Please try again or contact Customer Support.'
                        )
                    );
            }
        }

        return $this->createPageView()
            ->setVariable('form', $form)
            ->setVariable('panels', $panels)
            ->setTemplate('wellcart-admin/settings/update');
    }

    /**
     * @inheritdoc
     */
    protected function preDispatch($mvcEvent)
    {
        $section = $this->params('section', 'general');
        $permission = 'admin/system-settings/' . $section . '/view';
        $this->isGrantedOrDeny($permission);
    }
}
