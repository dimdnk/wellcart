<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\Base\Repository\Locale;

use PHPUnit\Framework\TestCase;
use WellCart\Base\Entity\Locale\Language;

class LanguagesQueryTest extends TestCase
{

    /**
     * @var LanguagesQuery
     */
    private $object;

    public function setUp()
    {
        $em = application()
            ->getServiceManager()
            ->get('Doctrine\ORM\EntityManager');
        $this->object = (
        new LanguagesQuery(
            $em
        )
        )
            ->select('t')
            ->from(Language::class, 't');
    }

    public function testActive()
    {
        $this->assertInstanceOf(
            LanguagesQuery::class,
            $this->object->active()
        );
    }

    public function testPrioritize()
    {
        $this->assertInstanceOf(
            LanguagesQuery::class,
            $this->object->prioritize()
        );
    }
}
