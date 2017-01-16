<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);
namespace WellCart\Router\Http;

use Doctrine\DBAL\Exception\TableNotFoundException;
use WellCart\Base\Spec\UrlRewriteEntity;
use WellCart\Base\Spec\UrlRewriteRepository;
use WellCart\Mvc\Application;
use Zend\Mvc\Router\Exception;
use Zend\Mvc\Router\Http\RouteInterface;
use Zend\Mvc\Router\Http\RouteMatch;
use Zend\Stdlib\RequestInterface as Request;
use Zend\Uri\Uri;

class SystemUrlRewrites implements RouteInterface
{

    /**
     * @var string
     */
    private static $requestPath;

    /**
     * @var UrlRewriteRepository
     */
    protected $urlRewrites;

    /**
     * System route constructor.
     *
     * @param UrlRewriteRepository|null $rewrites
     */
    public function __construct(UrlRewriteRepository $rewrites = null)
    {
        $this->urlRewrites = $rewrites;
    }

    /**
     * Create a new route with given options.
     *
     * @param  array|\Traversable $options
     *
     * @return SystemUrlRewrites
     */
    public static function factory($options = [])
    {
        if (!isset($options['repository'])) {
            throw new Exception\InvalidArgumentException(
                'Missing "repository" in options array'
            );
        }

        return new static($options['repository']);
    }

    /**
     * match(): defined by RouteInterface interface.
     *
     * @see    \Zend\Mvc\Router\RouteInterface::match()
     *
     * @param  Request $request
     *
     * @return RouteMatch|null
     */
    public function match(Request $request)
    {
        if (!application_context(Application::CONTEXT_FRONTEND)) {
            return;
        }
        if ($this->urlRewrites === null || self::$requestPath !== null
            || !method_exists($request, 'getUri')
        ) {
            return;
        }

        /**
         * @var $uri Uri
         */
        $uri = $request->getUri();
        $requestPath = ltrim($uri->getPath(), '/');
        $targetPath = false;

        if (empty($requestPath)) {
            return;
        }

        try {
            $urlRewrite = $this->urlRewrites->findOneByRequestPath(
                $requestPath
            );
        }
        catch (TableNotFoundException $e) {
            $urlRewrite = null;
        }

        if ($urlRewrite instanceof UrlRewriteEntity) {
            $targetPath = $urlRewrite->getTargetPath();
            $targetPath = '/' . ltrim($targetPath, '/');
            $uri->setPath($targetPath);
        }
        self::$requestPath = $targetPath;

        return;
    }

    /**
     * Assemble the route.
     *
     * @param  array $params
     * @param  array $options
     *
     * @return mixed
     */
    public function assemble(array $params = [], array $options = [])
    {

    }

    /**
     * Get a list of parameters used while assembling.
     *
     * @return array
     */
    public function getAssembledParams()
    {
        return [];
    }
}