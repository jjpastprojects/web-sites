var FancyMultiSelect = function(el) {
  el.width(el.width()).select2();
}

$(function() {
  $('select[multiple]').each(function() {
    FancyMultiSelect($(this));
  });
});