WellCart.Catalog.Category = DS.Model.extend({
    lft: DS.attr('number'),
    rgt: DS.attr('number'),
    root: DS.attr('number'),
    lvl: DS.attr('number'),
    is_visible: DS.attr('boolean'),
    url_key: DS.attr('string'),
    sort_order: DS.attr('number'),
    created_at: DS.attr('date'),
    updated_at: DS.attr('date')
});
