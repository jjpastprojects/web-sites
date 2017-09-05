var Redactor = function (el) {
    var buttons = [],
        csrf_token = $('meta[name=csrf-token]').attr('content'),
        csrf_param = $('meta[name=csrf-param]').attr('content'),
        params
    ;

    if (csrf_param !== undefined && csrf_token !== undefined) {
        params = csrf_param + "=" + encodeURIComponent(csrf_token);
    }

    options = {
        wym: true,
        buttonsAdd: buttons,
        imageUpload: "/redactor_rails/pictures?" + params,
        imageGetJson: "/redactor_rails/pictures",
        fileUpload: "/redactor_rails/documents?" + params,
        fileGetJson: "/redactor_rails/documents",
        path: "/assets/redactor-rails"
    };

    if (el.data('minheight'))
        options['minHeight'] = el.data('minheight')

    el.redactor(options);
}

$(function () {
    $('[data-action=redactor]').each(function () {
        new Redactor($(this));
    })
})