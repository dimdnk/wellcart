/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
;
jQuery(function ($, undefined) {
    'use strict';
    $(document).on('change', 'select.country-selector', function () {
        var select = $(this);
        var countryId = select.val();
        $.getJSON(
            WellCart.urlToRoute('zfcadmin/directory/zones', {action: 'get-zone-options'}),
            {country_id: countryId}, function (data) {
                var zoneSelector = $(select).closest('fieldset').find('select.zone-selector');
                zoneSelector.empty();
                $.each(data, function (ix, val) {
                    var option = $("<option></option>")
                        .attr("value", ix).text(val);
                    if (ix == '') {
                        option.attr('selected', 'selected');
                    }
                    zoneSelector.append(option);
                });
            });
    });
});