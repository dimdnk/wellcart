WellCart.Base.Language = DS.Model.extend({
    name: DS.attr('string'),
    code: DS.attr('string'),
    locale: DS.attr('string'),
    territory: DS.attr('string'),
    is_system: DS.attr('boolean'),
    is_default: DS.attr('boolean'),
    is_active: DS.attr('boolean'),
    sort_order: DS.attr('number'),
    created_at: DS.attr('date'),
    updated_at: DS.attr('date')
});
