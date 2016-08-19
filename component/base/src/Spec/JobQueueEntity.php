<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Base\Spec;

interface JobQueueEntity
{

    /**
     * Object constructor
     *
     */
    public function __construct();

    /**
     * @return \DateTimeInterface
     */
    public function getCreatedAt(): \DateTimeInterface;

    /**
     * @param \DateTimeInterface $createdAt
     *
     * @return JobQueueEntity
     */
    public function setCreatedAt(\DateTimeInterface $createdAt = null
    ): JobQueueEntity;

    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     *
     * @return JobQueueEntity
     */
    public function setId($id): JobQueueEntity;

    /**
     * @return string
     */
    public function getQueue();

    /**
     * @param string $queue
     *
     * @return JobQueueEntity
     */
    public function setQueue($queue): JobQueueEntity;

    /**
     * @return string
     */
    public function getData();

    /**
     * @param string $data
     *
     * @return JobQueueEntity
     */
    public function setData($data): JobQueueEntity;

    /**
     * @return string
     */
    public function getStatus();

    /**
     * @param int $status
     *
     * @return JobQueueEntity
     */
    public function setStatus($status): JobQueueEntity;

    /**
     * @return string
     */
    public function getMessage();

    /**
     * @param string $message
     *
     * @return JobQueueEntity
     */
    public function setMessage($message);

    /**
     * @return string
     */
    public function getTrace();

    /**
     * @param string $trace
     *
     * @return JobQueueEntity
     */
    public function setTrace($trace): JobQueueEntity;

    /**
     * @return \DateTimeInterface
     */
    public function getScheduledAt();

    /**
     * @param \DateTimeInterface $scheduledAt
     *
     * @return JobQueueEntity
     */
    public function setScheduledAt(\DateTimeInterface $scheduledAt = null
    ): JobQueueEntity;

    /**
     * @return \DateTimeInterface
     */
    public function getExecutedAt();

    /**
     * @param \DateTimeInterface $executedAt
     *
     * @return JobQueueEntity
     */
    public function setExecutedAt(\DateTimeInterface $executedAt = null
    ): JobQueueEntity;

    /**
     * @return \DateTimeInterface
     */
    public function getFinishedAt();

    /**
     * @param \DateTimeInterface $finishedAt
     *
     * @return JobQueueEntity
     */
    public function setFinishedAt(\DateTimeInterface $finishedAt = null
    ): JobQueueEntity;
}
