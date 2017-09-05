// $( "#sortable1, #sortable2" ).sortable({
//   connectWith: ".connectedSortable"
// }).disableSelection();

var Nested = function(el) {
  var items_query = [
    '> tbody[data-nested=item]',
    '> tbody > tr[data-nested=item]',
    '> [data-nested=item]'
  ];

  var fixHelper = function(e, ui) {
    ui.children().each(function() {
      $(this).width($(this).width());
    });
    return ui;
  };

  el.sortable({
    items: items_query.join(','),
    axis: 'y',
    placeholder: "placeholder",
    // connectWith: '[data-type=nested]',
    helper: fixHelper,
    forcePlaceholderSize: true,
    update: function(e, ui) {
      var items = [];
      el.find(items_query.join(',')).each(function() {
        items.push($(this).data('nested-id'));
      });

      $.post(el.data('nested-url'), {order: items});
    },
    start: function(e, ui) {
      ui.item.find('> td, > tr > td').each(function() {
        $(this).width($(this).width());
      });
    },
    stop: function(e, ui) {
      ui.item.children('tr:first-child').children('td').effect('highlight', {}, 1000)
    }
  }).disableSelection();
};


$(function() {
  $('[data-type=nested]').each(function() {
    new Nested($(this));
  });
});