ready = ->
  $("a[rel=popover]").popover()
  $(".tooltip").tooltip()
  $("[rel=tooltip]").tooltip({html: true})
  $('.tabs a:first').tab('show')
  $('.ajax-modal').on 'click', ->
    new window.AjaxModal($(@).data('url')).load()

  $('[data-time]').localDate()
  $('.countdown').timeRemaining()

$(document).ready(ready)
$(document).on('page:load', ready)
