<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\View\Helper\RequireJS;

class ConfigScript
{
	/**
	 * @var array
	 */
	protected $config;

	/**
	 * @param array $config RequireJS configuration (http://requirejs.org/docs/api.html#config)
	 */
	public function __construct(array $config)
	{
		$this->config = $config;
	}

	/**
	 * @param string|string[] $dependencies
	 */
	public function addDependencies($dependencies = array())
	{
		if (!is_array($dependencies))
		{
			$dependencies = array($dependencies);
		}

		$this->config['deps'] = array_merge_recursive($this->config['deps'], $dependencies);
	}

	public function __toString()
	{
		return 'var require = '. json_encode($this->config) .';';
	}
}
