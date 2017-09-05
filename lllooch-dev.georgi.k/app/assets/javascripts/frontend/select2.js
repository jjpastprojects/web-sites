
var FancySelect = function(el) {
    var options = {
        minimumResultsForSearch: -1
    };

    var thumbed = function(state) {
        var originalOption = state.element;

        var table = $('<table>').addClass('variant-option'),
            row = $('<tr>'),
            html = state.text
        ;

        if ($(originalOption).data('thumb'))
        {
            var thumb = $('<td>').append($('<img>').attr('src', $(originalOption).data('thumb')));
            var txt = $('<td>').html(state.text);
            table.append(row.append(thumb).append(txt));
            html = $('<div>').append(table).html();
        }

        return html;
    }

    if (el.data('format') == 'thumbed')
    {
        options['formatResult'] = thumbed;
        options['formatSelection'] = thumbed;
        options['escapeMarkup'] = function(m) { return m; }
    }

    el.select2(options);
};

$(document).on('ready page:load', function() {
    $('select').each(function() {
        new FancySelect($(this));
    });
});