WellCart.Admin.Administrator = DS.Model.extend({
    state: DS.attr('number'),
    email: DS.attr('string'),
    first_name: DS.attr('string'),
    last_name: DS.attr('string'),
    time_zone: DS.attr('string'),
    password: DS.attr('string'),
    password_reset_token: DS.attr('string'),
    email_confirmation_token: DS.attr('string'),
    failed_login_count: DS.attr('number'),
    created_at: DS.attr('date'),
    updated_at: DS.attr('date')
});
