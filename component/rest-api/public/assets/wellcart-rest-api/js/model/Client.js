WellCart.RestApi.Client = DS.Model.extend({
    client_id: DS.attr('string'),
    secret: DS.attr('string'),
    redirect_uri: DS.attr('string'),
    grant_type: DS.attr('string')
});
