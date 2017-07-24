<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\ORM\DBAL\Types;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;

/**
 * Timestamp type for the Doctrine
 */
class Timestamp extends Type
{
    /**
     * Type name
     *
     * @var string
     */
    const TIMESTAMP = 'timestamp';

    /**
     *
     * @return string
     */
    public function getName()
    {
        return self::TIMESTAMP;
    }

    public function getSqlDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return $platform->getIntegerTypeDeclarationSQL($fieldDeclaration);
    }

    /**
     * Converts the timestamp to a value for database insertion
     *
     * @param mixed $value
     * @param AbstractPlatform $platform
     *
     * @return int
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if ($value instanceof \DateTime) {
            return $value->getTimestamp();
        }
        return (int)$value;
    }

    /**
     * Converts a value loaded from the database to a DateTime instance
     *
     * @param int $value
     * @param AbstractPlatform $platform
     *
     * @return \DateTime
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if($value == '0000-00-00 00:00:00')
        {
          return null;
        } elseif(is_numeric($value))
        {
          return new \DateTime('@'.$value);
        } else {
          return new \DateTime($value);
        }
    }
}
