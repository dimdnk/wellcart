<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);
namespace WellCart\Form\View\Helper;

use TwbBundle\Form\View\Helper\TwbBundleFormCollection;
use Zend\Form\ElementInterface;

class FormCollection extends TwbBundleFormCollection
{

    /**
     * Where shall the template-data be inserted into
     *
     * @var string
     */
    protected $templateWrapper = '<template data-content="%s"></template>';

    /**
     * @var string
     */
    protected $partial;

    public function render(ElementInterface $oElement)
    {
        if ($legendFormat = $oElement->getOption('legend_format')) {
            static::$legendFormat = $legendFormat;
        }

        if ($fieldsetFormat = $oElement->getOption('fieldset_format')) {
            static::$fieldsetFormat = $fieldsetFormat;
        }

        if ($partial = $oElement->getOption('partial')) {
            $this->setPartial($partial);
        }

        if ($this->partial) {
            $vars = [
                'element' => $oElement,
                'context' => $this,
            ];

            $result = $this->view->render($this->partial, $vars);
            $this->setPartial(null);

            return $result;
        }

        return parent::render($oElement);
    }

    /**
     * @return string
     */
    public function getPartial()
    {
        return $this->partial;
    }

    /**
     * @param string $partial
     *
     * @return FormCollection
     */
    public function setPartial($partial)
    {
        $this->partial = $partial;

        return $this;
    }


}