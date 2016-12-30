<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\Base\Repository;

use PHPUnit\Framework\TestCase;
use WellCart\Base\Spec\UrlRewriteRepository;

class UrlRewritesTest extends TestCase
{

    /**
     * @var UrlRewrites
     */
    private $object;

    public function setUp()
    {
        $this->object = application()->getServiceManager()->get(
            UrlRewriteRepository::class
        );
    }

    public function testFinder()
    {
        $this->assertInstanceOf(
            UrlRewritesQuery::class,
            $this->object->finder()
        );
    }

    public function testCreateQueryBuilder()
    {
        $this->assertInstanceOf(
            UrlRewritesQuery::class,
            $this->object->createQueryBuilder('TestEntity')
        );
    }

    public function testFindOneByRequestPath()
    {
        $this->assertNull($this->object->findOneByRequestPath('request_path'));
    }
}
