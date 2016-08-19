WellCart.Admin.Notification = DS.Model.extend({
    icon: DS.attr('string'),
    title: DS.attr('string'),
    body: DS.attr('string'),
    is_read: DS.attr('boolean'),
    is_deleted: DS.attr('boolean'),
    created_at: DS.attr('date'),
    updated_at: DS.attr('date'),
    deleted_at: DS.attr('date')
});
