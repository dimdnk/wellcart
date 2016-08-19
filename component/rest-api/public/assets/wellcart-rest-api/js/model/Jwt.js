WellCart.RestApi.Jwt = DS.Model.extend({
    subject: DS.attr('string'),
    public_key: DS.attr('string')
});
