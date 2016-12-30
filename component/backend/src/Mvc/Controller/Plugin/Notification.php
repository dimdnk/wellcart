<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Backend\Mvc\Controller\Plugin;

use WellCart\Backend\Service\Notification as Notificator;
use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class Notification extends AbstractPlugin
{
    /**
     * @var Notificator
     */
    protected $notificator;

    /**
     * Notification constructor.
     *
     * @param Notificator $notificator
     */
    public function __construct(
        Notificator $notificator
    ) {
        $this->notificator = $notificator;
    }

    /**
     * @param string      $title
     * @param string      $body
     * @param string|null $icon
     *
     * @return \WellCart\ORM\Entity
     */
    public function __invoke(
        string $title,
        string $body,
        string $icon = null
    ) {
        return $this->notificator->notify($title, $body, $icon);
    }
}
