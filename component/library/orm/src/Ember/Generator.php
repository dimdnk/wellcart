<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\ORM\Ember;

class Generator
{
    /**
     * @var string
     */
    protected $appVariable = 'WellCart';

    /**
     * @var string
     */
    protected $path = WELLCART_STORAGE_PATH . 'code' . DS . 'ember';

    /**
     * @var \Twig_Environment
     */
    protected $twig;

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param array $classes
     */
    public function generate(array $classes)
    {
        $paths = [__DIR__];
        $this->twig = new \Twig_Environment(
            new \Twig_Loader_Filesystem($paths), array(
                'debug'            => false,
                'cache'            => false,
                'strict_variables' => true,
                'autoescape'       => false,
            )
        );


        foreach ($classes as $class) {
            $this->renderFile(
                'model.js.twig',
                $this->getModelPath($class),
                array(
                    'appVariable' => $this->appVariable,
                    'moduleName'  => str_replace(
                        $this->appVariable . '.', '', $class['moduleName']
                    ),
                    'modelName'   => $class['modelName'],
                    'fields'      => $class['fields'],
                )
            );
        }
    }

    /**
     * @param       $template
     * @param       $target
     * @param array $parameters
     *
     * @return integer
     */
    protected function renderFile($template, $target, array $parameters)
    {
        if (!is_dir(dirname($target))) {
            mkdir(dirname($target), 0775, true);
        }

        $content = $this->twig->render($template, $parameters);

        return file_put_contents($target, $content);
    }

    /**
     * @param array $class
     *
     * @return string
     */
    protected function getModelPath(array $class)
    {
        return sprintf(
            '%s/%s/js/model/%s.js', $this->path,
            strtolower(str_replace('.', '-', $class['moduleName'])),
            $class['modelName']
        );
    }
}
