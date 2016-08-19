<?php
/**
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

namespace Gedmo\Tree\Mapping\Driver;

use Doctrine\Common\Persistence\Mapping\MappingException;
use Gedmo\Mapping\Driver;
use WellCart\Utility\Config;

/**
 * This is a php array config mapping driver for Tree
 * behavioral extension. Used for extraction of extended
 * metadata from array specifically for Tree
 * extension.
 */
class SystemConfig extends Yaml implements Driver
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
