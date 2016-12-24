/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
;
jQuery(function ($, undefined) {
    'use strict';
    require(['bootstrap']);

    function containerHeight() {
        var availableHeight = $(window).height() - $('.page-container').offset().top;
        $('.page-container').attr('style', 'min-height:' + availableHeight + 'px');
    }

    containerHeight();
    $(window).on('resize', function () {
        setTimeout(function () {
            containerHeight();
        }, 100);
    }).resize();


    $(document).on('click', 'button.btn-create-new-row', function () {
        var btn = $(this);
        var source = btn.data('source-path');
        var target = btn.data('target-path');
        var template = $(source).find('template:first').data('content');
        var currentCount = $(target).children().length;
        template = template.replace(/__index__/g, currentCount);
        $(target).append(template);
        return false;
    });

    $(document).on('click', 'button.btn-remove-row', function () {
        $(this).closest('.row-fieldset').remove();
    });

    $(document).on('click', '[data-toggle="tab-ajax"]',
        function (e) {
            var $this = $(this),
                source = $this.data('source-path'),
                target = $this.data('target-path');
            $.get(source, function (data) {
                $(target).html(data);
            });
            $this.tab('show');
            return false;
        });


    $('.panel [data-action=collapse]').click(function (e) {
        e.preventDefault();
        var $panelCollapse = $(this).parent().parent().parent().parent().nextAll();
        $(this).parents('.panel').toggleClass('panel-collapsed');
        $(this).toggleClass('rotate-180');
        $panelCollapse.slideToggle(150);
    });
    $('.panel [data-action=close]').click(function (e) {
        e.preventDefault();
        var $panelClose = $(this).parent().parent().parent().parent().parent();
        $panelClose.slideUp(150, function () {
            $(this).remove();
        });
    });

    // ========================================
    //
    // Main navigation
    //
    // ========================================


    // Main navigation
    // -------------------------

    // Add 'active' class to parent list item in all levels
    $('.navigation').find('li.active').parents('li').addClass('active');

    // Hide all nested lists
    $('.navigation').find('li').not('.active, .category-title').has('ul').children('ul').addClass('hidden-ul');

    // Highlight children links
    $('.navigation').find('li').has('ul').children('a').addClass('has-ul');

    // Add active state to all dropdown parent levels
    $('.dropdown-menu:not(.dropdown-content), .dropdown-menu:not(.dropdown-content) .dropdown-submenu').has('li.active').addClass('active').parents('.navbar-nav .dropdown:not(.language-switch), .navbar-nav .dropup:not(.language-switch)').addClass('active');


    // Collapsible functionality
    // -------------------------

    // Main navigation
    $('.navigation-main').find('li').has('ul').children('a').on('click', function (e) {
        e.preventDefault();

        // Collapsible
        $(this).parent('li').not('.disabled').toggleClass('active').children('ul').slideToggle(250);

        // Accordion
        if ($('.navigation-main').hasClass('navigation-accordion')) {
            $(this).parent('li').not('.disabled').siblings(':has(.has-ul)').removeClass('active').children('ul').slideUp(250);
        }
    });


    require(['sluggable'], function (sluggableHelper) {
        /**
         * Process sluggable field
         *
         * @type {*|HTMLElement}
         */
        var slaggableElement = $("input[data-sluggable='true']");
        var slagSource = slaggableElement.data('slug-source');
        var slagOptions = {separator: '-'};
        if (typeof(slagSource) != "undefined") {

            $(slagSource).on('change', function (event) {
                if (slaggableElement.val() == '') {
                    var slugValue = sluggableHelper($(this).val(), slagOptions).substr(0, 50);
                    slaggableElement.val(slugValue);
                }
            });
        }
    });
});