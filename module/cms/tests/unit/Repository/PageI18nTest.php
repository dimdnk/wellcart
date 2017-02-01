<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\CMS\Test\Unit\Repository;

use PHPUnit\Framework\TestCase;
use WellCart\CMS\Entity\Page;
use WellCart\CMS\Entity\PageI18n;
use WellCart\CMS\Repository\PageI18nQuery;
use WellCart\CMS\Spec\PageI18nRepository;

class PageI18nTest extends TestCase
{

    /**
     * @var PageI18n
     */
    private $object;

    public function setUp()
    {
        $this->object = application()
            ->getServiceManager()
            ->get(
                PageI18nRepository::class
            );
    }

    public function testFinder()
    {
        $this->assertInstanceOf(
            PageI18nQuery::class,
            $this->object->finder()
        );
    }

    public function testCreateQueryBuilder()
    {
        $this->assertInstanceOf(
            PageI18nQuery::class,
            $this->object->createQueryBuilder('TestEntity')
        );
    }

    public function testFindPageById()
    {
        $this->assertNull(
            $this->object->findPageById(100)
        );
    }

    public function testCreatePageEntity()
    {
        $this->assertInstanceOf(
            Page::class,
            $this->object->createPageEntity()
        );
    }


    public function testPerformGroupDeletePages()
    {
        $this->assertInternalType(
            'array',
            $this->object->performGroupDeletePages([1])
        );
    }

    public function testFindAllPageIds()
    {
        $this->assertInternalType(
            'array',
            $this->object->findAllPageIds()
        );
    }
}
