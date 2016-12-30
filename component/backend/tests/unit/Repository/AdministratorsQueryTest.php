<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Backend\Repository;

use PHPUnit\Framework\TestCase;
use WellCart\Backend\Entity\Administrator;

class AdministratorsQueryTest extends TestCase
{
    /**
     * @var AdministratorsQuery
     */
    private $object;

    public function setUp()
    {
        $em = application()
            ->getServiceManager()
            ->get('Doctrine\ORM\EntityManager');

        $this->object = (new AdministratorsQuery($em))
            ->select('t')
            ->from(Administrator::class, 't');
    }

    public function testEnabled()
    {
        $this->assertInstanceOf(
            AdministratorsQuery::class,
            $this->object->enabled()
        );
    }

    public function testDisabled()
    {
        $this->assertInstanceOf(
            AdministratorsQuery::class,
            $this->object->disabled()
        );
    }

    public function testCleanExpiredPasswordResetTokens()
    {
        $this->assertInstanceOf(
            AdministratorsQuery::class,
            $this->object->cleanExpiredPasswordResetTokens()
        );
    }
}
