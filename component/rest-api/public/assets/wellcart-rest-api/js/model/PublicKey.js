WellCart.RestApi.PublicKey = DS.Model.extend({
    public_key: DS.attr('string'),
    private_key: DS.attr('string'),
    encryption_algorithm: DS.attr('string')
});
