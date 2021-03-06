<?php

namespace WellCart\Ui\Layout\Filter;

use Zend\Filter\FilterInterface;

/**
 * @package WellCart\Ui\Layout

 */
class CacheBusterFilter implements FilterInterface, RawValueAwareInterface
{
    /**
     *
     * @var string
     */
    protected $internalBasePath;

    /**
     *
     * @var string
     */
    protected $rawValue;

    /**
     *
     * @param string $internalBasePath
     */
    public function __construct($internalBasePath = './public')
    {
        $this->internalBasePath = $internalBasePath;
    }

    /**
     *
     * @param string $value
     * @return string
     */
    public function filter($value)
    {
        $file = $this->getFilePath($value);
        if (is_file($file) && is_readable($file)) {
            return $value . '?v=' . substr(md5_file($file), 0, 8);
        }
        return $value;
    }

    /**
     *
     * @param mixed $value
     */
    public function setRawValue($value)
    {
        $this->rawValue = $value;
    }

    /**
     *
     * @param string $value
     * @return string
     */
    protected function getFilePath($value)
    {
        if (null !== $this->rawValue) {
            $value = $this->rawValue;
        }
        return $this->internalBasePath . '/' . ltrim($value, '/');
    }
}
