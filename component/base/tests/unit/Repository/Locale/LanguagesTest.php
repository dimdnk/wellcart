<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Base\Repository\Locale;

use PHPUnit\Framework\TestCase;
use WellCart\Base\Spec\LocaleLanguageEntity;
use WellCart\Base\Spec\LocaleLanguageRepository;

class LanguagesTest extends TestCase
{

    /**
     * @var Languages
     */
    private $object;

    public function setUp()
    {
        $this->object = application()
            ->getServiceManager()
            ->get(LocaleLanguageRepository::class);
    }

    public function testFinder()
    {
        $this->assertInstanceOf(
            LanguagesQuery::class,
            $this->object->finder()
        );
    }

    public function testCreateQueryBuilder()
    {
        $this->assertInstanceOf(
            LanguagesQuery::class,
            $this->object->createQueryBuilder('TestEntity')
        );
    }

    public function testFindDefaultLanguage()
    {
        $this->assertInstanceOf(
            LocaleLanguageEntity::class,
            $this->object->findDefaultLanguage()
        );
    }

    public function testEnsureDefaultLanguage()
    {
        $language = $this->object->findDefaultLanguage();
        $this->assertInstanceOf(
            LocaleLanguageEntity::class,
            $this->object->ensureDefaultLanguage($language)
        );
    }
}
