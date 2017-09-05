class Contest
  constructor: ->
    @bindAll()

  bindAll:->
    $(".contest-filter .filter").on 'click', ->
      $(".filter-result").find("tr.contest").show()
      filter = $(@).data('filter')

      if filter != 'all'
        $(".filter-result").find("tr.contest:not('."+filter+"')").hide()

$(document).on "ready page:load": ->
  new Contest
