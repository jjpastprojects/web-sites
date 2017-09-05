var Ga = function (el) {
    var data = el.data('ga-data'),
        category = el.data('ga-category'),
        label = el.data('da-label') || false,
        action = el.data('ga-action') || 'click'
        ;

    var variables = {
        'hitType': 'event',          // Required.
        'eventCategory': category,   // Required.
        'eventAction': action,      // Required.
        'eventValue': data
    };

    if (label) variables['eventLabel'] = label;

    el.on('click', function () {
        ga('send', variables);
    });
};

$(document).on('ready page:load', function() {
    $('[data-ga-category]').each(function () {
        new Ga($(this));
    });
})