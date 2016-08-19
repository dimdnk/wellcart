WellCart.Catalog.Brand = DS.Model.extend({
    name: DS.attr('string'),
    image_full_path: DS.attr('string'),
    meta_title: DS.attr('string'),
    meta_keywords: DS.attr('string'),
    meta_description: DS.attr('string'),
    created_at: DS.attr('date'),
    updated_at: DS.attr('date')
});
