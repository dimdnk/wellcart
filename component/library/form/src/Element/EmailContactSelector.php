<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\Form\Element;


use WellCart\Utility\Config;

class EmailContactSelector extends Select
{

    /**
     * @param  null|int|string $name    Optional name for the element
     * @param  array           $options Optional options for the element
     */
    public function __construct($name = null, $options = [])
    {
        parent::__construct($name, $options);
        $contacts = Config::get('wellcart.email_communications.contacts', []);
        $valueOptions = [];
        foreach ($contacts as $code => $contact) {
            $valueOptions[$code] = $contact['name'];
        }

        $this->setValueOptions($valueOptions);
    }
}