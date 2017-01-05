<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Base\EventListener\Ui;

use WellCart\Utility\Arr;
use WellCart\Utility\Config;
use Zend\EventManager\EventInterface;
use Zend\Form\Element;
use Zend\Form\FieldsetInterface;

class PrepareFormLayout
{
    /**
     * @param EventInterface $event
     */
    public function __invoke(EventInterface $event)
    {
        $form = $event->getTarget();
        $name = $form->getName();
        $config = Config::get('ui.form.'.$name, []);
        if(empty($config))
        {
          return;
        }
        $this->composeForm($form, $config);
    }

  /**
   * Compose form layout
   *
   * @param FieldsetInterface $fieldset
   * @param array             $config
   */
    public function composeForm(
      FieldsetInterface $fieldset,
        array $config
    )
    {
      foreach ($fieldset->getIterator() as $element)
      {
        if($element instanceof FieldsetInterface)
        {
          $this->composeForm($element, Arr::get($config, $element->getName(), []));
          continue;
        }

        $name =  $element->getName();
        $elementConfig = Arr::get($config, 'elements.' . $name, []);
        if(!empty($elementConfig))
        {
          $this->composeElement($element, $elementConfig);
        }
        unset($elementConfig);
      }
    }

    protected function composeElement(
      Element $element,
      array $config
    )
    {
      $options = Arr::get($config, 'options', []);
      foreach ($options as $option => $value)
      {
        switch ($option) {
          case 'label_attributes':
            $element->setLabelAttributes($value);
            break;
          default:
            $element->setOption($option, $value);
            break;
        }
      }
      $attributes = Arr::get($config, 'attributes', []);
      foreach ($attributes as $attribute => $value)
      {
        $element->setAttribute($attribute, $value);

      }
      unset($options,$attributes);
    }
}
