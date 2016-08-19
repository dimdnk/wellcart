WellCart.Catalog.ProductVariant = DS.Model.extend({
    quantity: DS.attr('number'),
    sku: DS.attr('string'),
    price: DS.attr('number'),
    created_at: DS.attr('date'),
    updated_at: DS.attr('date')
});
