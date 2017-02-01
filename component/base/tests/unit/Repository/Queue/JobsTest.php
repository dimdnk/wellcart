<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\Base\Test\Unit\Repository\Queue;

use PHPUnit\Framework\TestCase;
use WellCart\Base\Repository\Queue\Jobs;
use WellCart\Base\Repository\Queue\JobsQuery;
use WellCart\Base\Spec\JobQueueRepository;

class JobsTest extends TestCase
{

    /**
     * @var Jobs
     */
    private $object;

    public function setUp()
    {
        $this->object = application()
            ->getServiceManager()
            ->get(JobQueueRepository::class);
    }

    public function testFinder()
    {
        $this->assertInstanceOf(
            JobsQuery::class,
            $this->object->finder()
        );
    }

    public function testCreateQueryBuilder()
    {
        $this->assertInstanceOf(
            JobsQuery::class,
            $this->object->createQueryBuilder('TestEntity')
        );
    }
}
