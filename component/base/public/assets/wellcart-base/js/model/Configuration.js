WellCart.Base.Configuration = DS.Model.extend({
    config_key: DS.attr('string'),
    config_value: DS.attr('string'),
    created_at: DS.attr('date'),
    updated_at: DS.attr('date')
});
