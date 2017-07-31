<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\View\Helper;

use Zend\View\Helper\Escaper\AbstractHelper;

class EscapeHtmlAttr extends \Zend\View\Helper\EscapeHtmlAttr
{
  public function __invoke($value, $recurse = self::RECURSE_NONE)
  {
    if(empty($value))
    {
      $value = null;
    }
    return parent::__invoke($value, $recurse);
  }

}