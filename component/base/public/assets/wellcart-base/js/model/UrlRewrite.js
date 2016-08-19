WellCart.Base.UrlRewrite = DS.Model.extend({
    request_path: DS.attr('string'),
    target_path: DS.attr('string'),
    is_system: DS.attr('boolean'),
    created_at: DS.attr('date'),
    updated_at: DS.attr('date')
});
