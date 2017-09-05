var Scrollbar = function(el) {
  el.on('size:change', function() {
    el.height(el.height());
    el.perfectScrollbar('update');  
  })
  el.perfectScrollbar();
};

$(function() {
  $('[data-action=scrollbar]').each(function() {
    new Scrollbar($(this));
  });
});