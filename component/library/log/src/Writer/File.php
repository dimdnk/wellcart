<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);
namespace WellCart\Log\Writer;

class File extends Stream
{

    /**
     * Close the stream resource.
     *
     * @return void
     */
    public function shutdown()
    {
    }

    /**
     * Write a message to the log.
     *
     * @param array $event event data
     *
     * @return void
     */
    protected function doWrite(array $event)
    {
        $line = $this->formatter->format($event) . $this->logSeparator;
        @file_put_contents($this->streamOrUrl, $line, FILE_APPEND);
    }
}
