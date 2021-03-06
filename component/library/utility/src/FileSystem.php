<?php
/**
 * WellCart Utility Library
 *
 * @copyright    Copyright (c) 2017 WellCart Dev Team (http://wellcart.org)
 * @license      http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */


namespace WellCart\Utility;

use FilesystemIterator;
use SplFileObject;

/**
 * File system.
 */
class FileSystem
{

    /**
     * Mime types.
     *
     * @var array
     */
    protected $mimeTypes
        = [
            'aac'        => 'audio/aac',
            'atom'       => 'application/atom+xml',
            'avi'        => 'video/avi',
            'bmp'        => 'image/x-ms-bmp',
            'c'          => 'text/x-c',
            'class'      => 'application/octet-stream',
            'css'        => 'text/css',
            'csv'        => 'text/csv',
            'deb'        => 'application/x-deb',
            'dll'        => 'application/x-msdownload',
            'dmg'        => 'application/x-apple-diskimage',
            'doc'        => 'application/msword',
            'docx'       => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'exe'        => 'application/octet-stream',
            'flv'        => 'video/x-flv',
            'gif'        => 'image/gif',
            'gz'         => 'application/x-gzip',
            'h'          => 'text/x-c',
            'htm'        => 'text/html',
            'html'       => 'text/html',
            'ics'        => 'text/calendar',
            'ical'       => 'text/calendar',
            'ini'        => 'text/plain',
            'jar'        => 'application/java-archive',
            'java'       => 'text/x-java',
            'jpeg'       => 'image/jpeg',
            'jpg'        => 'image/jpeg',
            'js'         => 'text/javascript',
            'json'       => 'application/json',
            'jp2'        => 'image/jp2',
            'mid'        => 'audio/midi',
            'midi'       => 'audio/midi',
            'mka'        => 'audio/x-matroska',
            'mkv'        => 'video/x-matroska',
            'mp3'        => 'audio/mpeg',
            'mp4'        => 'video/mp4',
            'mpeg'       => 'video/mpeg',
            'mpg'        => 'video/mpeg',
            'm4a'        => 'video/mp4',
            'm4v'        => 'video/mp4',
            'odt'        => 'application/vnd.oasis.opendocument.text',
            'ogg'        => 'audio/ogg',
            'pdf'        => 'application/pdf',
            'php'        => 'text/x-php',
            'png'        => 'image/png',
            'psd'        => 'image/vnd.adobe.photoshop',
            'py'         => 'application/x-python',
            'ra'         => 'audio/vnd.rn-realaudio',
            'ram'        => 'audio/vnd.rn-realaudio',
            'rar'        => 'application/x-rar-compressed',
            'rss'        => 'application/rss+xml',
            'safariextz' => 'application/x-safari-extension',
            'sh'         => 'text/x-shellscript',
            'shtml'      => 'text/html',
            'swf'        => 'application/x-shockwave-flash',
            'tar'        => 'application/x-tar',
            'tif'        => 'image/tiff',
            'tiff'       => 'image/tiff',
            'torrent'    => 'application/x-bittorrent',
            'txt'        => 'text/plain',
            'wav'        => 'audio/wav',
            'webp'       => 'image/webp',
            'wma'        => 'audio/x-ms-wma',
            'xls'        => 'application/vnd.ms-excel',
            'xml'        => 'text/xml',
            'zip'        => 'application/zip',
            '3gp'        => 'video/3gpp',
            '3g2'        => 'video/3gpp2',
        ];

    /**
     * Writes the supplied data to a file.
     *
     * @param   string  $file File path
     * @param   mixed   $data File data
     * @param   boolean $lock (optional) Acquire an exclusive write lock?
     *
     * @return  int|boolean
     */
    public static function putContents($file, $data, $lock = false)
    {
        return file_put_contents($file, $data, $lock ? LOCK_EX : 0);
    }

    /**
     * Prepends the supplied data to a file.
     *
     * @param   string  $file File path
     * @param   mixed   $data File data
     * @param   boolean $lock (optional) Acquire an exclusive write lock?
     *
     * @return  int|boolean
     */
    public static function prependContents($file, $data, $lock = false)
    {
        return file_put_contents(
            $file, $data . file_get_contents($file), $lock ? LOCK_EX : 0
        );
    }

    /**
     * Appends the supplied data to a file.
     *
     * @param   string  $file File path
     * @param   mixed   $data File data
     * @param   boolean $lock (optional) Acquire an exclusive write lock?
     *
     * @return  int|boolean
     */
    public static function appendContents($file, $data, $lock = false)
    {
        return file_put_contents(
            $file, $data, $lock ? FILE_APPEND | LOCK_EX : FILE_APPEND
        );
    }

    /**
     * Truncates a file.
     *
     * @param   string  $file File path
     * @param   boolean $lock (optional) Acquire an exclusive write lock?
     *
     * @return  boolean
     */
    public static function truncateContents($file, $lock = false)
    {
        return (0 === file_put_contents($file, null, $lock ? LOCK_EX : 0));
    }

    /**
     * Returns TRUE if a file exists and FALSE if not.
     *
     * @param   string $file Path to file
     *
     * @return  boolean
     */
    public function exists($file)
    {
        return file_exists($file);
    }

    /**
     * Returns TRUE if the provided path is a file and FALSE if not.
     *
     * @param   string $file Path to file
     *
     * @return  boolean
     */
    public function isFile($file)
    {
        return is_file($file);
    }

    /**
     * Returns TRUE if the provided path is a directory and FALSE if not.
     *
     * @param   string $directory Path to directory
     *
     * @return  boolean
     */
    public function isDirectory($directory)
    {
        return is_dir($directory);
    }

    /**
     * Returns TRUE if a directory is empty and FALSE if not.
     *
     * @param   string $path Path to directory
     *
     * @return  boolean
     */
    public function isDirectoryEmpty($path)
    {
        $files = scandir($path);

        foreach ($files as $file) {
            if ($file !== '.' && $file !== '..') {
                return false;
            }
        }

        return true;
    }

    /**
     * Returns TRUE if the file is readable and FALSE if not.
     *
     * @param   string $file Path to file
     *
     * @return  boolean
     */
    public function isReadable($file)
    {
        return is_readable($file);
    }

    /**
     * Returns TRUE if the file or directory is writable and FALSE if not.
     *
     * @param   string $file Path to file
     *
     * @return  boolean
     */
    public function isWritable($file)
    {
        return is_writable($file);
    }

    /**
     * Returns the time (unix timestamp) the file was last modified.
     *
     * @param   string $file Path to file
     *
     * @return  int
     */
    public function lastModified($file)
    {
        return filemtime($file);
    }

    /**
     * Returns the fize of the file in bytes.
     *
     * @param   string $file Path to file
     *
     * @return  int
     */
    public function size($file)
    {
        return filesize($file);
    }

    /**
     * Returns the extension of the file.
     *
     * @param   string $file Path to file
     *
     * @return  string
     */
    public function extension($file)
    {
        return pathinfo($file, PATHINFO_EXTENSION);
    }

    /**
     * Returns the mime type of the file.
     *
     * @param   string  $file  Path to file
     * @param   boolean $guess (optinal) Guess mime type if finfo_open doesn't exist?
     *
     * @return  string
     */
    public function mime($file, $guess = true)
    {
        if (function_exists('finfo_open')) {
            // Get mime using the file information functions

            $info = finfo_open(FILEINFO_MIME_TYPE);

            $mime = finfo_file($info, $file);

            finfo_close($info);

            return $mime;
        } else {
            // @codeCoverageIgnoreStart
            if ($guess === true) {
                // Just guess mime by using the file extension

                $extension = pathinfo($file, PATHINFO_EXTENSION);

                return isset($this->mimeTypes[$extension])
                    ? $this->mimeTypes[$extension] : false;
            } else {
                return false;
            }
            // @codeCoverageIgnoreEnd
        }
    }

    /**
     * Deletes a directory and its contents from disk.
     *
     * @param   string $path Path to directory
     *
     * @return  boolean
     */
    public function deleteDirectory($path)
    {
        $iterator = new FilesystemIterator($path);

        foreach ($iterator as $item) {
            // @codeCoverageIgnoreStart
            /**
             * @var $item SplFileObject
             */
            if ($item->isDir()) {
                $this->deleteDirectory($item->getPathname());
            } else {
                $this->delete($item->getPathname());
            }
            // @codeCoverageIgnoreEnd
        }

        return rmdir($path);
    }

    /**
     * Deletes the file from disk.
     *
     * @param   string $file Path to file
     *
     * @return  boolean
     */
    public function delete($file)
    {
        return unlink($file);
    }

    /**
     * Returns an array of pathnames matching the provided pattern.
     *
     * @param   string $pattern Patern
     * @param   int    $flags   (optional) Flags
     *
     * @return  array|bool
     */
    public function glob($pattern, $flags = 0)
    {
        return glob($pattern, $flags);
    }

    /**
     * Returns the contents of the file.
     *
     * @param   string $file File path
     *
     * @return  string|boolean
     */
    public function getContents($file)
    {
        return file_get_contents($file);
    }

    /**
     * Includes a file.
     *
     * @codeCoverageIgnore
     *
     * @param   string $file Path to file
     *
     * @return  mixed
     */
    public function includeFile($file)
    {
        return include $file;
    }

    /**
     * Includes a file it hasn't already been included.
     *
     * @codeCoverageIgnore
     *
     * @param   string $file Path to file
     *
     * @return  mixed
     */
    public function includeFileOnce($file)
    {
        return include_once $file;
    }

    /**
     * Requires a file.
     *
     * @codeCoverageIgnore
     *
     * @param   string $file Path to file
     *
     * @return  mixed
     */
    public function requireFile($file)
    {
        return require $file;
    }

    /**
     * Requires a file if it hasn't already been required.
     *
     * @codeCoverageIgnore
     *
     * @param   string $file Path to file
     *
     * @return  mixed
     */
    public function requireFileOnce($file)
    {
        return require_once $file;
    }

    /**
     * Returns a SplFileObject.
     *
     * @param   string  $file           Path to file
     * @param   string  $openMode       (optional) Open mode
     * @param   boolean $useIncludePath (optional) Use include path?
     *
     * @return  \SplFileObject
     */
    public function file($file, $openMode = 'r', $useIncludePath = false)
    {
        return new SplFileObject($file, $openMode, $useIncludePath);
    }

    /**
     * Copy a file
     *
     * @param string $src
     * @param string $destination
     *
     * @return boolean
     */
    public function copy($src, $destination)
    {
        $src = str_replace('\\', '/', $src);
        $filename = pathinfo($src, PATHINFO_BASENAME);
        $destination = str_replace('\\', '/', $destination);
        list($destDir) = explode($filename, $destination);
        $this->createDirectory($destDir, 0775, true);
        if (!is_writable($destDir)) {
            chmod($destDir, 0775);
        }

        return @copy($src, $destination);
    }

    /**
     *  Creates a directory.
     *
     * @access  public
     *
     * @param   string  $path      Path to directory
     * @param   int     $mode      (optional) Mode
     * @param   boolean $recursive (optional) Recursive
     *
     * @return  boolean
     */
    public function createDirectory($path, $mode = 0777, $recursive = false)
    {
        if (is_dir($path)) {
            return true;
        }

        return mkdir($path, $mode, $recursive);
    }

    /**
     * Creates a symbolic link
     *
     * @param string $src
     * @param string $destination
     *
     * @return boolean
     */
    public function symlink($src, $destination)
    {
        $src = str_replace('\\', '/', $src);
        $filename = pathinfo($src, PATHINFO_BASENAME);
        $destination = str_replace('\\', '/', $destination);
        list($destDir) = explode($filename, $destination);
        $this->createDirectory($destDir, 0775, true);
        if (!is_writable($destDir)) {
            chmod($destDir, 0775);
        }

        return symlink($src, $destination);
    }
}