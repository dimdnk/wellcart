<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Mvc\Controller\Feature\Crud;

trait FindOrNotFoundTrait
{
    protected function findOrNotFound($errorMessage,
        $route = null,
        $params = [],
        $options = [],
        $reuseMatchedParams = false,
        $method = 'find'
    ) {
        $id = abs((int)$this->params()->fromRoute('id'));
        $entity = call_user_func_array([$this->repository, $method], [$id]);

        if (!$entity) {
            $this->flashMessenger()
                ->addErrorMessage($errorMessage);

            $this->redirect()->toRoute(
                $route,
                $params,
                $options,
                $reuseMatchedParams
            );
        }
        return $entity;
    }
}