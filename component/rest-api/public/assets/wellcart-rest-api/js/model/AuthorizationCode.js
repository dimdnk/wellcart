WellCart.RestApi.AuthorizationCode = DS.Model.extend({
    authorization_code: DS.attr('string'),
    redirect_uri: DS.attr('string'),
    expires: DS.attr('date'),
    id_token: DS.attr('string')
});
