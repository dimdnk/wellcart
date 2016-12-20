<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\User\PageView\Backend;

use WellCart\Admin\PageView\Form\Standard;

class PreferencesForm extends Standard
{

    /**
     * @inheritdoc
     */
    public function prepare($template = null, $values = null)
    {
        if ($this->isPrepared()) {
            return $this;
        }
        $this->addLayoutHandle('user/preferences/form');
        $this->setPageTitle(__('Users'))
            ->setFormTitle(__('SignUp & SignIn Options'))
            ->setBreadcrumbs(
                [
                    'list' => [
                        'label'  => __('Users'),
                        'route'  => 'zfcadmin/user/accounts',
                        'params' => [],
                    ],
                ]
            );

        return parent::prepare($template, $values);
    }
}
