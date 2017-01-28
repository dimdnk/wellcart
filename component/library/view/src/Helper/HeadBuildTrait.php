<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\View\Helper;

use WellCart\Utility\Config;
use Zend\View\Exception\InvalidArgumentException;
use Zend\View\Exception\RuntimeException;

trait HeadBuildTrait
{

    protected $publicPath;

    protected $manifestFile;

    protected $config;

    /**
     *
     * @param string $method Method to call
     * @param  array $args   Arguments of method
     *
     * @return \Zend\View\Helper\Placeholder\Container\AbstractStandalone
     * @throws RuntimeException if "rev-manifest.json" not exists
     * @throws InvalidArgumentException the file not exists in "rev-manisfest.json"
     */
    public function __call($method, $args)
    {

        if (preg_match('/build$/i', $method)) {
            $method = preg_replace('/build$/i', '', $method);

            if (is_string($args[0])) {
                $src = &$args[0];
            } else {
                $src = &$args[1];
            }
            $publicPath = $this->getPublicPath();
            $basePath = $this->getView()->basePath();
            $newSrc = trim(str_replace($basePath, '', $src), '\/');

            $manifestFile = $this->getManifestFile();

            $manifestPullPath = realpath("$publicPath/$manifestFile");

            if (!is_file($manifestPullPath)) {
                throw new RuntimeException(
                    "The file \"{$manifestFile}\" not exists in \"{$publicPath}\""
                );
            }
            $manifest = json_decode(file_get_contents($manifestPullPath), true);

            if (!isset($manifest[$newSrc])) {
                throw new InvalidArgumentException(
                    "The \"{$src}\" not exists in \"{$manifestFile}\""
                );
            }

            $baseBuildPath = $this->getBaseBuildPath(
                $manifestPullPath,
                $basePath ?: dirname($_SERVER['SCRIPT_FILENAME'])
            );
            $src = $basePath . '/' . ($baseBuildPath . '/'
                    . $manifest[$newSrc]);
        }

        return parent::__call($method, $args);
    }

    /**
     * @return string
     * @throws \RuntimeException
     */
    public function getPublicPath()
    {
        if ($this->publicPath) {
            return $this->publicPath;
        }
        $path = Config::get(
            'headbuild.public_path', $this->generatePublicPath()
        );
        if (!is_dir($path)) {
            throw new \RuntimeException("$path is not a valid path");
        }

        return $this->publicPath = rtrim($path, '\/');
    }

    /**
     * @return string
     */
    public function generatePublicPath()
    {
        $cwd = realpath(getcwd());
        $filename = realpath($_SERVER['SCRIPT_FILENAME']);

        $publicDir = preg_replace(
            '/[^\\\\\/]*$/', '', str_replace($cwd, '', $filename)
        );

        return realpath(trim($publicDir, '\/'));
    }

    private function getManifestFile()
    {
        if ($this->manifestFile) {
            return $this->manifestFile;
        }
        $path = $this->manifestFile = Config::get(
            'headbuild.manifest_file',
            WELLCART_ASSETS_PATH . 'revision-manifest.json'
        );

        return $path;
    }

    private function getBaseBuildPath($manifestPullPath, $basePath)
    {
        $basePath = str_replace('\\', '/', $basePath);
        $manifestPullPath = str_replace('\\', '/', $manifestPullPath);

        $buildPath = explode($basePath, $manifestPullPath);
        $buildPath = end($buildPath);
        $buildPath = preg_replace('/\/.*$/', '', trim($buildPath, '/'));

        return $buildPath;
    }

}
