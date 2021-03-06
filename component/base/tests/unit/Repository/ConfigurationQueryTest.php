<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\Base\Test\Unit\Repository;

use WellCart\Test\TestCase;
use WellCart\Base\Repository\ConfigurationQuery;
use WellCart\Base\Spec\ConfigurationRepository;

class ConfigurationQueryTest extends TestCase
{

    /**
     * @var ConfigurationQuery
     */
    private $object;

    public function setUp()
    {
        $this->object = application()
            ->getServiceManager()
            ->get(
                ConfigurationRepository::class
            )->finder();
    }

    public function testGetValueByKey()
    {
        $this->assertNull($this->object->getValueByKey('test_key'));
    }
}
