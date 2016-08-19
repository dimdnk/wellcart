WellCart.User.Permission = DS.Model.extend({
    name: DS.attr('string'),
    description: DS.attr('string'),
    is_system: DS.attr('boolean'),
    created_at: DS.attr('date'),
    updated_at: DS.attr('date')
});
