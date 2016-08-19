WellCart.Catalog.ProductImage = DS.Model.extend({
    full_path: DS.attr('string'),
    filename: DS.attr('string'),
    original_filename: DS.attr('string'),
    description: DS.attr('string'),
    image_x: DS.attr('number'),
    image_y: DS.attr('number'),
    created_at: DS.attr('date'),
    updated_at: DS.attr('date')
});
