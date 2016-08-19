/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
;
'use strict';

require(['wellcart', 'tinymce'],
    function (WellCart, tinymce) {
        tinymce.baseURL = WellCart.urlToRoute('assets') + 'lib/tinymce/';
        tinymce.init({
            selector: 'textarea.wysiwyg-tinymce',
            menubar: false,
            height: 400
        });
    });