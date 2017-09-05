var PhoneMask = function(el) {
    el.inputmask({ mask: "+7 (999) 999-99-99", showTooltip: true, "greedy": false })
}

$(document).on('page:load ready', function() {
    $('[data-mask=phone]').each(function() {
        new PhoneMask($(this));
    });
});