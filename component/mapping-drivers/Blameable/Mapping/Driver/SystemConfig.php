<?php
/**
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

namespace Gedmo\Blameable\Mapping\Driver;

use Doctrine\Common\Persistence\Mapping\MappingException;
use WellCart\Utility\Config;

/**
 * This is a php array config mapping driver for Blameable
 * behavioral extension. Used for extraction of extended
 * metadata from array specifically for Blameable
 * extension.
 */
class SystemConfig extends Yaml
{
    /**
     * File extension
     *
     * @var string
     */
    protected $_extension = '.php';

    /**
     * {@inheritDoc}
     */
    protected function _loadMappingFile($file)
    {
        return [];
    }

    /**
     * {@inheritDoc}
     */
    protected function _getMapping($className)
    {
        $mapping = Config::get(
            'object_mapping.' . str_replace('.', '\\', $className),
            Config::get(
                'object_mapping.' . str_replace('\\', '\\\\', $className)
            )
        );
        if ($mapping === null) {
            throw MappingException::invalidMappingFile($className, $className);
        }

        return $mapping;
    }
}
