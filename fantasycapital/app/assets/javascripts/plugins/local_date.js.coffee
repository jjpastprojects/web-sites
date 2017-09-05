# Example:
# var formatted = $.localDate('2014-01-28 09:03:57 UTC')
$.localDate = (isoDate) ->
  date = moment(isoDate)
  date.format('ddd h:mm a')

# Example:
#   $('[data-time]').localDate()
$.fn.localDate = ->
  @each ->
    el = $(@)
    formatted = $.localDate(el.data('time'))
    el.text(formatted)

