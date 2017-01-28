<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\Form;

use WellCart\InputFilter\DomainInputFilterSpecConfigTrait;
use WellCart\ORM\Entity;
use Zend\Form\FormFactoryAwareInterface;
use Zend\InputFilter\InputFilterProviderInterface;

class Fieldset extends \Zend\Form\Fieldset
    implements FormFactoryAwareInterface, InputFilterProviderInterface
{

    use DomainInputFilterSpecConfigTrait,
        AddAttributesToRequiredFieldsTrait;

    /**
     * @inheritdoc
     */
    public function getInputFilterSpecification()
    {
        $specs = [];
        if ($this->object instanceof InputFilterProviderInterface) {
            $specs = $this->object->getInputFilterSpecification();
        }
        if ($this->object instanceof Entity) {
            $specs = $this->getDomainEntityInputFilterSpecification(
                $this->object
            );

        }
        $this->addAttributesToRequiredFields($specs);

        return $specs;
    }
}