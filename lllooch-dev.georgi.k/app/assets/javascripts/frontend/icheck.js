var iRadio = function(el) {
    el.iCheck({
        checkboxClass: 'icheckbox_minimal',
        radioClass: 'iradio_minimal',
        increaseArea: '20%' // optional
    }).on('ifChanged', function() {
        el.trigger('click');
    });
}

$(document).on('ready page:load', function() {
    $('input[type=radio]').each(function() {
        new iRadio($(this));
    });
});