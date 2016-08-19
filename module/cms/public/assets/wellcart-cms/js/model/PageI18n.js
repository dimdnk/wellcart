WellCart.CMS.PageI18n = DS.Model.extend({
    title: DS.attr('string'),
    body: DS.attr('string'),
    meta_title: DS.attr('string'),
    meta_keywords: DS.attr('string'),
    meta_description: DS.attr('string'),
    page_id: DS.attr('number'),
    created_at: DS.attr('date'),
    updated_at: DS.attr('date')
});
