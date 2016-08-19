WellCart.CMS.Page = DS.Model.extend({
    url_key: DS.attr('string'),
    status: DS.attr('number'),
    created_at: DS.attr('date'),
    updated_at: DS.attr('date')
});
