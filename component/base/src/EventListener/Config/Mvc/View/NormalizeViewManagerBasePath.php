<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Base\EventListener\Config\Mvc\View;

use Zend\EventManager\EventInterface;

class NormalizeViewManagerBasePath
{

    /**
     * @param EventInterface $event
     *
     * @return bool
     */
    public function __invoke(EventInterface $event)
    {
        $values = &$event->getParam('values');
        foreach ($values as $key => $value) {
            if ($key == 'router.base_path') {
                $values['view_manager.base_path'] = $value;
                break;
            }
        }

        return true;
    }
}
