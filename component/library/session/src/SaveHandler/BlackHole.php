<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Session\SaveHandler;


use Zend\Session\SaveHandler\SaveHandlerInterface;

final class BlackHole implements SaveHandlerInterface
{

    /**
     * Open Session - retrieve resources
     *
     * @param string $savePath
     * @param string $name
     *
     * @return bool
     */
    public function open($savePath, $name)
    {
        return true;
    }

    /**
     * Close Session - free resources
     *
     */
    public function close()
    {
        return true;
    }

    /**
     * Read session data
     *
     * @param string $id
     *
     * @return string
     */
    public function read($id)
    {
        return '';
    }

    /**
     * Write Session - commit data to resource
     *
     * @param string $id
     * @param string $data
     *
     * @return bool
     */
    public function write($id, $data)
    {
        return true;
    }

    /**
     * Destroy Session - remove data from resource for
     * given session id
     *
     * @param string $id
     *
     * @return bool
     */
    public function destroy($id)
    {
        return true;
    }

    /**
     * Garbage Collection - remove old session data older
     * than $maxlifetime (in seconds)
     *
     * @param int|string $maxlifetime
     *
     * @return bool
     */
    public function gc($maxlifetime)
    {
        return true;
    }
}