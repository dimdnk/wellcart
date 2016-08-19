WellCart.RestApi.Jti = DS.Model.extend({
    subject: DS.attr('string'),
    audience: DS.attr('string'),
    expires: DS.attr('date'),
    jti: DS.attr('string')
});
