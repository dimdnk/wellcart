<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\View\Factory\Helper;

use Interop\Container\ContainerInterface;
use WellCart\View\Helper\RequireJS;

class RequireJSFactory
{
  public function __invoke(ContainerInterface $container): RequireJS
	{
    $container = $container->getServiceLocator();
		$config = $container->get('Configuration');

		if (PHP_SAPI != 'cli')
		{
			$helpers = $container->get('ViewHelperManager');
			$basePath = $helpers->get('BasePath');

			$config['config']['baseUrl'] = call_user_func($basePath, rtrim($config['config']['baseUrl'], '/'));

			if (parse_url($config['library'], PHP_URL_HOST) === null)
			{
				$config['library'] = call_user_func($basePath, $config['library']);
			}
		}

		foreach ($config['config']['paths'] as $name => $spec)
		{
			if (!is_array($spec))
			{
				continue;
			}

			$config['config']['paths'][$name] = array_values($spec);
		}

		return new RequireJS(new \WellCart\View\Helper\RequireJS\ConfigScript($config['config']), $config['library']);
	}
}
