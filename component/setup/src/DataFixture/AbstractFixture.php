<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Setup\DataFixture;

use Doctrine\Common\DataFixtures\AbstractFixture as Fixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

abstract class AbstractFixture
    extends Fixture implements
    FixtureInterface,
    OrderedFixtureInterface,
    SetupDataFixtureInterface
{
    /**
     * @var int
     */
    protected $version;

    /**
     * AbstractFixture constructor.
     */
    public function __construct($version)
    {
        $this->version = $version;
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return $this->version;
    }
}
