<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\Base\Repository;

use PHPUnit\Framework\TestCase;
use WellCart\Base\Spec\ConfigurationRepository;

class ConfigurationTest extends TestCase
{

    /**
     * @var Configuration
     */
    private $object;

    public function setUp()
    {
        $this->object = application()
            ->getServiceManager()
            ->get(ConfigurationRepository::class);
    }

    public function testFinder()
    {
        $this->assertInstanceOf(
            ConfigurationQuery::class,
            $this->object->finder()
        );
    }

    public function testCreateQueryBuilder()
    {
        $this->assertInstanceOf(
            ConfigurationQuery::class,
            $this->object->createQueryBuilder('TestEntity')
        );
    }
}
