var InputQnt = function(el) {
    var controls = el.find('[data-input=control]'),
        input = el.find('input'),
        old_val = input.val()
    ;

    input.attr('readonly', true);

    var inputVal = function() {
        return input.val()/1;
    };

    var check = function(value) {
        if (value < 1) value = 1;
        return value;
    };

    var change = function(increase) {
        var value = (inputVal() + (increase ? 1 : -1))
        value = check(value);
        input.val(value);

        if (old_val != value)
        {
            old_val = value;
            input.trigger('change');
        }
    };

    controls.on('click', function() {
        change($(this).hasClass('plus'))
    });
};


$(document).on('page:load ready', function() {
    $('[data-type=input-qnt]').each(function() {
        new InputQnt($(this));
    });
});