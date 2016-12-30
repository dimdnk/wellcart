<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Base\Entity\Locale\Language;

use WellCart\Base\Entity\Locale\Language as AbstractEntity;
use WellCart\Base\Spec\LocaleLanguageEntity;

class DefaultLanguage extends AbstractEntity implements LocaleLanguageEntity
{

    /**
     * ID
     *
     * @var int
     */
    protected $id = 0;

    /**
     * Name
     *
     * @var string
     */
    protected $name = 'English';

    /**
     * Locale Code
     *
     * @var string
     */
    protected $code = 'en';

    /**
     * Locale
     *
     * @var string
     */
    protected $locale = 'en_US';

    /**
     * Territory
     *
     * @var string
     */
    protected $territory = 'en';

    /**
     * Is default locale
     *
     * @var bool
     */
    protected $isDefault = true;

    /**
     * Is active locale
     *
     * @var bool
     */
    protected $isActive = true;

    /**
     * Sort order
     *
     * @var int
     */
    protected $sortOrder = 0;
}
