<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Admin\View\Helper;

use Zend\View\Helper\AbstractHelper;

class Notification extends AbstractHelper
{
    /**
     * @var array
     */
    protected $recentMessages;
    /**
     * @var int
     */
    protected $recentCount = 0;

    /**
     * Notification constructor.
     *
     * @param int   $recentCount
     * @param array $recent
     */
    public function __construct(
        int $recentCount,
        array $recent
    ) {
        $this->recentCount = $recentCount;
        $this->recentMessages = $recent;
    }

    /**
     * @return Notification
     */
    public function __invoke(): Notification
    {
        return $this;
    }

    /**
     * @return array
     */
    public function getMessages(): array
    {
        return $this->recentMessages;
    }

    /**
     * @return int
     */
    public function getRecentCount(): int
    {
        return $this->recentCount;
    }
}
