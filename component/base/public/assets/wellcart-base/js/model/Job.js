WellCart.Base.Job = DS.Model.extend({
    queue: DS.attr('string'),
    data: DS.attr('string'),
    message: DS.attr('string'),
    trace: DS.attr('string'),
    status: DS.attr('number'),
    created_at: DS.attr('date'),
    scheduled_at: DS.attr('date'),
    executed_at: DS.attr('date'),
    finished_at: DS.attr('date')
});
