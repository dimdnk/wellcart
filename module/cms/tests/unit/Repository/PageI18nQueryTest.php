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
use WellCart\Base\Entity\Locale\Language;
use WellCart\CMS\Repository\PageI18nQuery;
use WellCart\CMS\Spec\PageI18nRepository;

class PageI18nQueryTest extends TestCase
{

    /**
     * @var PageI18nQuery
     */
    private $object;

    public function setUp()
    {
        $this->object = application()
            ->getServiceManager()
            ->get(
                PageI18nRepository::class
            )->finder();
    }

    public function testFilterByLanguage()
    {
        $language = new Language();
        $this->assertInstanceOf(
            PageI18nQuery::class,
            $this->object->filterByLanguage($language)
        );
    }

    public function testWithPage()
    {
        $this->assertInstanceOf(
            PageI18nQuery::class,
            $this->object->withPage()
        );
    }
}
