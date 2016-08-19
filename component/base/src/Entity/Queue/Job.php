<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Base\Entity\Queue;

use WellCart\Base\Spec\JobQueueEntity;
use WellCart\ORM\AbstractEntity;
use WellCart\Utility\Time;

class Job extends AbstractEntity implements JobQueueEntity
{

    /**
     * ID
     *
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $queue;

    /**
     * @var string
     */
    protected $data;

    /**
     * @var int
     */
    protected $status;

    /**
     * @var string
     */
    protected $message;

    /**
     * @var string
     */
    protected $trace;

    /**
     * Created at
     *
     * @var \DateTimeInterface
     */
    protected $createdAt;

    /**
     * Scheduled at
     *
     * @var \DateTimeInterface
     */
    protected $scheduledAt;

    /**
     * Executed at
     *
     * @var \DateTimeInterface
     */
    protected $executedAt;

    /**
     * Finished at
     *
     * @var \DateTimeInterface
     */
    protected $finishedAt;

    /**
     * @inheritdoc
     */
    public function __construct()
    {
        $this->setCreatedAt(new Time());
    }

    /**
     * @inheritdoc
     */
    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @inheritdoc
     */
    public function setCreatedAt(\DateTimeInterface $createdAt = null
    ): JobQueueEntity
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function setId($id): JobQueueEntity
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getQueue()
    {
        return $this->queue;
    }

    /**
     * @inheritdoc
     */
    public function setQueue($queue): JobQueueEntity
    {
        $this->queue = $queue;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @inheritdoc
     */
    public function setData($data): JobQueueEntity
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @inheritdoc
     */
    public function setStatus($status): JobQueueEntity
    {
        $this->status = (int)$status;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @inheritdoc
     */
    public function setMessage($message): JobQueueEntity
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getTrace()
    {
        return $this->trace;
    }

    /**
     * @inheritdoc
     */
    public function setTrace($trace): JobQueueEntity
    {
        $this->trace = $trace;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getScheduledAt()
    {
        return $this->scheduledAt;
    }

    /**
     * @inheritdoc
     */
    public function setScheduledAt(\DateTimeInterface $scheduledAt = null
    ): JobQueueEntity
    {
        $this->scheduledAt = $scheduledAt;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getExecutedAt()
    {
        return $this->executedAt;
    }

    /**
     * @inheritdoc
     */
    public function setExecutedAt(\DateTimeInterface $executedAt = null
    ): JobQueueEntity
    {
        $this->executedAt = $executedAt;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getFinishedAt()
    {
        return $this->finishedAt;
    }

    /**
     * @inheritdoc
     */
    public function setFinishedAt(\DateTimeInterface $finishedAt = null
    ): JobQueueEntity
    {
        $this->finishedAt = $finishedAt;
        return $this;
    }
}
