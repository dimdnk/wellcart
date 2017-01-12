<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Backend\PageView\Form;

use WellCart\Backend\PageView\EntityPageView;
use WellCart\Form\Form;
use WellCart\ORM\Entity;

class Standard extends EntityPageView
{

    /**
     * Default layout handle for form
     */
    protected $layout = 'ui/form/standard';

    /**
     * Form Title
     *
     * @var string
     */
    protected $formTitle = 'Standard Form';

    /**
     * Data Object
     *
     * @var Entity
     */
    protected $entity;

    /**
     * Form Object
     *
     * @var Form
     */
    protected $form;

    /**
     * Template to use when rendering this model
     *
     * @var string
     */
    protected $template = 'wellcart-backend/page-view/form/standard/layout';

    /**
     * @return Form
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * @param Form $form
     *
     * @return Standard
     */
    public function setForm(Form $form)
    {
        $this->form = $form;
        $this->setVariable('form', $form);

        return $this;
    }

    /**
     * @return string
     */
    public function getFormTitle()
    {
        return $this->formTitle;
    }

    /**
     * @param string $formTitle
     *
     * @return Standard
     */
    public function setFormTitle($formTitle)
    {
        $this->formTitle = $formTitle;
        $this->setVariable('formTitle', $formTitle);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function prepare($template = null, $values = null)
    {
        if ($this->isPrepared()) {
            return $this;
        }

        $handle = $this->layout;
        $this->addLayoutHandle($handle, -1);
        $entity = $this->getEntity();
        if ($entity && $entity->getId()) {
            $this->addLayoutHandle($handle . '/update', -1);
        } else {
            $this->addLayoutHandle($handle . '/create', -1);
        }

        $repository = $this->getRepository();
        $pager = $this->getPager();
        if ($repository && $pager->isEmpty()) {
            $entity = $this->getEntity();
            if ($entity && $entity->getId()) {
                $previous = $repository->findPreviousRecord($entity);
                $next = $repository->findNextRecord($entity);
                if ($previous) {
                    $pager->setPreviousUrl(
                        url_to_route(
                            null,
                            ['action' => 'update', 'id' => $previous->getId()]
                        )
                    );
                }
                if ($next) {
                    $pager->setNextUrl(
                        url_to_route(
                            null,
                            ['action' => 'update', 'id' => $next->getId()]
                        )
                    );
                }
            }
        }

        return parent::prepare($template, $values);
    }

    /**
     * @return Entity
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * Setup data object
     *
     * @param Entity $entity
     *
     * @return Standard
     */
    public function setEntity(Entity $entity)
    {
        $this->entity = $entity;
        $this->setVariable('entity', $entity);

        return $this;
    }
}
