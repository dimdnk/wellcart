<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);
namespace WellCart\ORM\Mapping\Driver;

use Doctrine\Common\Persistence\Mapping\MappingException;
use Doctrine\ORM\Mapping\Driver\YamlDriver;
use WellCart\Utility\Config;

class SystemConfigDriver extends YamlDriver
{

    /**
     * Gets the element of schema meta data for the class from the mapping file.
     * This will lazily load the mapping file if it is not loaded yet.
     *
     * @param string $className
     *
     * @return array The element of schema meta data.
     *
     * @throws MappingException
     */
    public function getElement($className)
    {
        if ($this->classCache === null) {
            $this->initialize();
        }

        if (isset($this->classCache[$className])) {
            return $this->classCache[$className];
        }

        $result = Config::get(
            'domain.mapping.' . str_replace('.', '\\', $className),
            Config::get(
                'domain.mapping.' . str_replace('\\', '\\\\', $className)
            )
        );
        if ($result === null) {
            throw MappingException::invalidMappingFile($className, $className);
        }
        $this->classCache[$className] = $result;

        return $result;
    }

    /**
     * {@inheritDoc}
     */
    protected function initialize()
    {
        $this->classCache = [];
    }

    /**
     * {@inheritDoc}
     */
    public function getAllClassNames()
    {
        return array_keys(Config::get('domain.mapping', []));
    }

    /**
     * {@inheritDoc}
     */
    protected function loadMappingFile($file)
    {
        return [];
    }
}