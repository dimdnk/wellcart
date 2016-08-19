WellCart.Catalog.CategoryI18n = DS.Model.extend({
    category_id: DS.attr('number'),
    language_id: DS.attr('number'),
    name: DS.attr('string'),
    description: DS.attr('string'),
    meta_title: DS.attr('string'),
    meta_keywords: DS.attr('string'),
    meta_description: DS.attr('string')
});
