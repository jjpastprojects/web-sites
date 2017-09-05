var Datepicker = function(el) {
    el.datepicker({
        language: "ru-RU",
        format: "dd.mm.yyyy"
    });
};

$(function() {
    $("input.date_picker").each(function() {
        new Datepicker($(this));
    });
});