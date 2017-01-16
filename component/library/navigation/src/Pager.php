<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);
namespace WellCart\Navigation;

use Zend\Stdlib\AbstractOptions;

class Pager extends AbstractOptions
{

    /**
     * Previous URL
     *
     * @var string
     */
    protected $previousUrl;

    /**
     * Previous label
     *
     * @var string
     */
    protected $previousLabel;

    /**
     * Next URL
     *
     * @var string
     */
    protected $nextUrl;

    /**
     * Next label
     *
     * @var string
     */
    protected $nextLabel;


    /**
     * @return mixed
     */
    public function getPreviousUrl(): string
    {
        return (string)$this->previousUrl;
    }

    /**
     * @param mixed $previousUrl
     *
     * @return Pager
     */
    public function setPreviousUrl(string $previousUrl)
    {
        $this->previousUrl = $previousUrl;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNextUrl(): string
    {
        return (string)$this->nextUrl;
    }

    /**
     * @param mixed $nextUrl
     *
     * @return Pager
     */
    public function setNextUrl(string $nextUrl)
    {
        $this->nextUrl = $nextUrl;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPreviousLabel(): string
    {
        return (string)$this->previousLabel;
    }

    /**
     * @param mixed $previousLabel
     *
     * @return Pager
     */
    public function setPreviousLabel(string $previousLabel)
    {
        $this->previousLabel = $previousLabel;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNextLabel(): string
    {
        return (string)$this->nextLabel;
    }

    /**
     * @param mixed $nextLabel
     *
     * @return Pager
     */
    public function setNextLabel(string $nextLabel)
    {
        $this->nextLabel = $nextLabel;

        return $this;
    }

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        return
            (empty($this->previousUrl)
                && empty($this->nextUrl));
    }
}