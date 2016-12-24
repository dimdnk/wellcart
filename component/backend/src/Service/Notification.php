<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Backend\Service;

use WellCart\Backend\Spec\NotificationRepository;

class Notification
{

    /**
     * @var NotificationRepository
     */
    protected $repository;

    /**
     * Object constructor
     *
     * @param NotificationRepository $repository
     */
    public function __construct(
        NotificationRepository $repository
    ) {
        $this->repository = $repository;
    }

    /**
     * @param int $limit
     *
     * @return array
     */
    public function recentMessages(int $limit = 0): array
    {
        return $this->repository->finder()->recent($limit);
    }

    /**
     * @return int
     */
    public function recentCount(): int
    {
        return $this->repository
            ->finder()
            ->defaultScope()
            ->count();
    }


    /**
     * @param string      $title
     * @param string      $body
     * @param string|null $icon
     *
     * @return \WellCart\ORM\Entity
     */
    public function notify(
        string $title,
        string $body,
        string $icon = null
    ) {
        $notification = $this->repository->createEntity();
        if ($icon === null) {
            $icon = 'fa fa-clock-o';
        }

        $notification->setTitle($title)
            ->setBody($body)
            ->setIcon($icon);
        $this->repository->add($notification);
        return $notification;
    }
}
