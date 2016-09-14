/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
;
'use strict';

require(['jquery', 'bootstrap', 'datetimepicker', 'daterangepicker', 'bootstrap-switch', 'nanoscroller', 'chosen'],
    function ($, Bootstrap, datetimepicker, daterangepicker, bootstrapSwitch, nanoScroller, chosen) {

        var switcherEl = document.querySelector('.switchery-element');
        if (switcherEl !== null) {
            var switcherInit = new Switchery(switcherEl);
        }

        var $doc = $(document);

        $doc.popover({
            selector: '[data-toggle="popover"]',
            container: 'body'
        });

        $doc.tooltip({
            selector: 'a[rel="tooltip"], [data-toggle="tooltip"]',
            container: 'body'
        });

        $('input.icheck-element').icheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        });

        $("input.switch-element").bootstrapSwitch();

        $(".nscroller-element").nanoScroller();

        $("select.chosen-element").chosen({width: '100%'});

        $('input[type="date"]').datetimepicker({
            format: 'YYYY-MM-DD'
        });

        $('input[type="time"]').datetimepicker({
            format: 'HH:mm'
        });

        $('input[type="datetime"]').datetimepicker({
            format: 'YYYY-MM-DD HH:mm'
        });

        $('input[type="daterange"]').daterangepicker({
            timePicker: true,
            timePicker12Hour: false,
            format: 'YYYY-MM-DD HH:mm'
        });

    });