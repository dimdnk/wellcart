<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\View\Model;

use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerAwareTrait;
use Zend\View\Model\ConsoleModel as Model;

class ConsoleModel extends Model implements
    EventManagerAwareInterface
{

    use EventManagerAwareTrait;

    /**
     * Constructor
     *
     * @param  null|array|\Traversable $variables
     * @param  array|\Traversable      $options
     */
    public function __construct($variables = null, $options = null)
    {
        parent::__construct($variables, $options);
        $this->setVariable('context', $this);
        $this->getEventManager()
            ->setIdentifiers(
                [
                    __CLASS__,
                    get_class($this),
                ]
            );
    }
}