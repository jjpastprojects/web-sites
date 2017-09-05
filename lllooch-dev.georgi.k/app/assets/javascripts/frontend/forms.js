var Form = function(el) {
    var invalidInputs = el.find('input.invalid');

    invalidInputs.on('focus', function() {
        $(this).removeClass('invalid');
    });
};

$(document).on('ready page:load', function() {
    $('form').each(function() {
        new Form($(this));
    })
})