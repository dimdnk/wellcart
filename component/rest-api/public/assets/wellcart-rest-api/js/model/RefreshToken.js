WellCart.RestApi.RefreshToken = DS.Model.extend({
    refresh_token: DS.attr('string'),
    expires: DS.attr('date')
});
