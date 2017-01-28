<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\Mvc\Controller\Feature\Crud;

use WellCart\Backend\PageView\Form\Standard as FormPageView;
use WellCart\Form\Form;
use WellCart\ORM\Entity;
use WellCart\Utility\Arr;

trait HandleEntityFormTrait
{

    /**
     * @param FormPageView $pageView
     * @param Form         $form
     * @param  object      $entityContainer
     * @param  string      $messageOnCreate
     * @param  string      $messageOnUpdate
     * @param  string      $route              Route name
     * @param  array       $params             Parameters to use in url generation, if any
     * @param  array       $options            RouteInterface-specific options to use in url generation, if any
     * @param  bool        $reuseMatchedParams Whether to reuse matched parameters
     *
     * @return \WellCart\Ui\Container\PreparableContainerInterface
     */
    protected function handleEntityForm(
        FormPageView $pageView,
        Form $form,
        $entityContainer,
        $messageOnCreate,
        $messageOnUpdate,
        $route = null,
        $params = [],
        $options = [],
        $reuseMatchedParams = false
    ) {
        $entity = $entityContainer;
        if (!$entityContainer instanceof Entity) {
            if (is_object($entityContainer)
                && method_exists($entityContainer, 'getEntity')
            ) {
                $entity = $entityContainer->getEntity();
            }
        }
        /**
         * @var $form EntityForm
         */
        $form = $form->bind($entity);

        $pageView
            ->setEntity($entity)
            ->setForm($form);

        $id = null;
        if ($entity->getId() > 0) {
            $id = $entity->getId();
        }

        /**
         * @var $request Request
         */
        $request = $this->getRequest();
        $prg = (!$form->isMultipart()) ? $this->prg() : [];
        if ($request->isPost()) {
            $post = $request->getPost($form->getName(), []);
            $files = $request->getFiles($form->getName(), []);
            $post = Arr::merge(
                $post, $files, true
            );

            $form->setData($post);
            if ($form->isValid()) {
                $entity = $form->getData();
                $entity->setId($id);

                return $this->attemptToPersistEntity(
                    $entityContainer,
                    $messageOnCreate,
                    $messageOnUpdate,
                    $route,
                    $params,
                    $options,
                    $reuseMatchedParams
                );
            }
        } elseif (!empty($prg[$form->getName()])) {
            $form->setData((array)$prg[$form->getName()]);
            $form->isValid();
        }

        $pageView->prepare();

        return $pageView;
    }
}