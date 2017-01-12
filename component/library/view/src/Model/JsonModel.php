<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\View\Model;

use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerAwareTrait;
use Zend\View\Model\JsonModel as Model;

class JsonModel extends Model implements
    EventManagerAwareInterface
{

    use EventManagerAwareTrait;

    /**
     * @inheritDoc
     */
    public function __construct($variables = null, $options = null)
    {
        parent::__construct($variables, $options);
        $this->getEventManager()
            ->setIdentifiers(
                [
                    __CLASS__,
                    get_class($this),
                ]
            );
    }

}