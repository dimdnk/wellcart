<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Log\Writer;

use Traversable;
use Zend\Log\Exception;
use Zend\Log\Formatter\Simple as SimpleFormatter;
use Zend\Log\Writer\AbstractWriter;
use Zend\Log\Writer\Stream as StreamWriter;
use Zend\Stdlib\ErrorHandler;

class Stream extends StreamWriter
{
    protected $lines = [];
    protected $streamOrUrl;
    protected $streamMode;

    /**
     * Constructor
     *
     * @param  string|resource|array|Traversable $streamOrUrl  Stream or URL to open as a stream
     * @param  string|null                       $mode         Mode, only applicable if a URL is given
     * @param  null|string                       $logSeparator Log separator string
     *
     * @return Stream
     * @throws Exception\InvalidArgumentException
     * @throws Exception\RuntimeException
     */
    public function __construct(
        $streamOrUrl, $mode = null, $logSeparator = null
    ) {
        if ($streamOrUrl instanceof Traversable) {
            $streamOrUrl = iterator_to_array($streamOrUrl);
        }

        if (is_array($streamOrUrl)) {
            AbstractWriter::__construct($streamOrUrl);
            $mode = isset($streamOrUrl['mode']) ? $streamOrUrl['mode'] : null;
            $logSeparator = isset($streamOrUrl['log_separator'])
                ? $streamOrUrl['log_separator'] : null;
            $streamOrUrl = isset($streamOrUrl['stream'])
                ? $streamOrUrl['stream'] : null;
        }

        // Setting the default mode
        if (null === $mode) {
            $mode = 'a';
        }

        $this->streamMode = $mode;
        $this->streamOrUrl = $streamOrUrl;

        if (null !== $logSeparator) {
            $this->setLogSeparator($logSeparator);
        }

        if ($this->formatter === null) {
            $this->formatter = new SimpleFormatter();
        }
    }

    /**
     * Close the stream resource.
     *
     * @return void
     */
    public function shutdown()
    {
        if (count($this->lines)) {
            $this->prepareStream();
            foreach ($this->lines as $line) {
                fwrite($this->stream, $line);
            }
        }
        parent::shutdown();
    }

    private function prepareStream()
    {
        $streamOrUrl = $this->streamOrUrl;
        $mode = $this->streamMode;

        if (is_resource($streamOrUrl)) {
            if ('stream' != get_resource_type($streamOrUrl)) {
                throw new Exception\InvalidArgumentException(
                    sprintf(
                        'Resource is not a stream; received "%s',
                        get_resource_type($streamOrUrl)
                    )
                );
            }

            if ('a' != $mode) {
                throw new Exception\InvalidArgumentException(
                    sprintf(
                        'Mode must be "a" on existing streams; received "%s"',
                        $mode
                    )
                );
            }

            $this->stream = $streamOrUrl;
        } else {
            ErrorHandler::start();
            $this->stream = fopen($streamOrUrl, $mode, false);
            $error = ErrorHandler::stop();
            if (!$this->stream) {
                throw new Exception\RuntimeException(
                    sprintf(
                        '"%s" cannot be opened with mode "%s"',
                        $streamOrUrl,
                        $mode
                    ), 0, $error
                );
            }
        }

    }

    /**
     * Write a message to the log.
     *
     * @param array $event event data
     *
     * @return void
     * @throws Exception\RuntimeException
     */
    protected function doWrite(array $event)
    {
        $line = $this->formatter->format($event) . $this->logSeparator;
        $this->lines[] = $line;
    }
}