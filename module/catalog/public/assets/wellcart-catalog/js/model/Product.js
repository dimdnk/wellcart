WellCart.Catalog.Product = DS.Model.extend({
    parent_id: DS.attr('number'),
    status: DS.attr('boolean'),
    url_key: DS.attr('string'),
    sort_order: DS.attr('number'),
    created_at: DS.attr('date'),
    updated_at: DS.attr('date')
});
