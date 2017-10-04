<?php
/**
 * @package
 
 */

namespace WellCart\Ui\Layout\Generator;

use Zend\Config\Config;

interface GeneratorInterface
{
    /**
     * @param Config $layoutStructure
     * @return mixed
     */
    public function generate(Config $layoutStructure);
}
