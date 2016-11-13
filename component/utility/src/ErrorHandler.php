<?php
/**
 * WellCart Utility Library
 *
 * @copyright    Copyright (c) 2016 WellCart Dev Team (http://wellcart.org)
 * @license      http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */


namespace WellCart\Utility;

use ErrorException;
use Throwable;

/**
 * Simple Error Handler
 *
 * @codeCoverageIgnore
 */
final class ErrorHandler
{
    /**
     * PHP error handler, converts all errors into ErrorExceptions. This handler
     * respects error_reporting settings.
     *
     * @param int         $code
     * @param string      $error
     * @param string|NULL $file
     * @param string|NULL $line
     *
     * @return bool
     * @throws ErrorException
     */
    public function convertErrorsToExceptions(
        $code, $error, $file = null, $line = null
    ) {
        if (error_reporting() && $code) {
            if ($code == E_USER_DEPRECATED) {
                //error_log('Deprecated: ' . $error);
                return true;
            }
            // This error is not suppressed by current error reporting settings
            // Convert the error into an ErrorException
            throw new ErrorException($error, $code, 0, $file, $line);
        }

        // Do not execute the PHP error handler
        return true;
    }

    /**
     * Inline exception handler, displays the error page.
     *
     * @param Throwable $e
     *
     * @return void
     */
    public function maintenanceModeOnExceptionRaising(Throwable $e)
    {
        $this->enableMaintenanceMode("Internal Server Error", $e);
    }

    /**
     * Show maintenance page
     *
     * @param string    $reason
     * @param Exception $e
     */
    public function enableMaintenanceMode(
        $reason = "Internal Server Error", Throwable $e = null
    ) {
        $textMessage = "Maintenance mode enabled: \n";
        $textMessage .= "Reason: " . $reason . "\n";
        if (!is_null($e)) {
            $textMessage .= "Exception: \n" . $e->__toString();
        }

        error_log($textMessage);

        if (!headers_sent() && PHP_SAPI !== 'cli') {
            if (isset($_SERVER['SERVER_PROTOCOL'])) {
                // Use the default server protocol
                $protocol = $_SERVER['SERVER_PROTOCOL'];
            } else {
                // Default to using newer protocol
                $protocol = 'HTTP/1.1';
            }

            // HTTP status
            header($protocol . ' 500 Internal Server Error');
        }

        if (PHP_SAPI == 'cli') {
            // Just display the text of the exception
            echo "\n{$textMessage}\n";
            exit(1);
        } elseif (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])
            && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
        ) {
            if (!headers_sent()) {
                header('Content-type: application/json');
            }
            $error = [
                'code'    => 500,
                'type'    => 'error',
                'message' => $reason,
            ];
            if (!is_null($e)) {
                $error['code'] = $e->getCode();
                $error['type'] = get_class($e);
                $error['message'] = $e->getMessage();
                $error['file'] = $e->getFile();
                $error['line'] = $e->getLine();
            }
            echo json_encode(['error' => $error]);
            exit(1);
        }

        $template = getcwd() . DS . 'Maintenance.html';
        if (!is_file($template)) {
            $template = __DIR__ . '/Resources/Maintenance.html';
        }
        $template = file_get_contents($template);
        exit(
        str_replace(
            array('{exception}', '{reason}'), array($textMessage, $reason),
            $template
        )
        );
    }

    /**
     * Catches errors that are not caught by the error handler, such as E_PARSE.
     *
     * @return void
     */
    public function maintenanceModeOnShutdown()
    {
        try {
            $e = error_get_last();
            if (!empty($e) && is_array($e)) {
                if (ob_get_contents()) {
                    ob_end_clean();
                }
                throw new ErrorException(
                    $e["message"], $e['type'], $e['type'], $e['file'],
                    $e['line']
                );
            }
        } catch (ErrorException $e) {
            if (error_reporting()) {
                $this->enableMaintenanceMode("Internal Server Error", $e);
            } else {
                error_log($e->__toString());
            }
        }
    }
}