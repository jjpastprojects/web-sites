class Lineup
  salary_cap: 0
  entries:    []

  constructor: (salary_param, entries_param) ->
    ###
    @fixHeight()
    ###
    that        = @
    @salary_cap = $('#contest-salary-cap').data('salary') || salary_param
    @entries = entries_param || []
    $(".lineup-spot").each (i, obj) ->
      that.entries.push(new Entry($(@)))

    $('a#clear-lineups').on 'click', ->
      if confirm("Are you sure to clear your lineup?")
        that.clear()

    $('a.add-to-lineup').on 'click', ->
      # add player to lineup if eligible, and remove from DOM. 'that' is the constructed lineup.
      player = new window.PlayerStats($(@).closest('tr.contest-player'))

      eligible_spots = (spot for spot in that.entries when (spot.position is player.position or spot.position is 'UTIL') and not spot.player)
      if eligible_spots.length is 0
        alert "Please remove player from position "+player.position
      else
        eligible_spots[0].player = player
        # this is really a backbone view, but for now we just mess with it in HTML. Ultimately
        # we should transition this Lineup logic into backbone.
        $('tr[data-player-id="'+player.id+'"]').hide()
      that.updateView()
    # else
    #   alert "You can't add this player. Salary limit reached!"

    $('a.remove-from-lineup').on 'click', ->

      spot_seq = $(@).data('lineup-spot')
      spots = (spot for spot in that.entries when spot.spot is spot_seq and not not spot.player)
      for spot in spots
        $('tr[data-player-id="'+spot.player.id+'"]').show()
        spot.player = ''
      that.updateView()
    @updateView()

    $('#new_lineup').submit (event) ->
      spots = (spot for spot in that.entries when not spot.player)
      if spots.length is not 0
        alert "Team needs to be completely filled before it can be submitted."
        return false
      if that.amountLeft() < 0
        alert "You can't submit the lineup with negative balance."
        return false
      return true
  handleRedColor: () ->
    if @amountLeft() >= 0
      $("#avg-rem-salary, #contest-salary-cap").parent().children().removeClass("red")
    else
      $("#avg-rem-salary, #contest-salary-cap").parent().children().addClass("red")
  setSalaryCap: (value) ->
    if typeof value == "number"
      if value > 0
        @salary_cap = value
      else
        @salary_cap = 0
    else
      @salary_cap = 0
  addEntry: (el) ->
    if el instanceof Entry
      @entries.push(el)
    else
      @entries.push(new Entry($(el)))
  getNumberOfEntries: ->
    @entries.length
  getAllEntries: ->
    @entries
  clearEntries: ->
    @entries = []
  getAllSalaries: ->
    alloted_spots = (spot for spot in @entries when not not spot.player)
    alloted_spots.map((entry) ->
      entry.player.salary
    )
  getMinPlayerSalary: ->
    Math.min.apply(Math, @getAllSalaries())
  getMaxPlayerSalary: ->
    Math.max.apply(Math, @getAllSalaries())
  getSalaryCap: ->
    @salary_cap
  consumedSalary: ->
    @getAllSalaries().reduce (a, b) ->
      a + b
    , 0
  amountLeft: ->
    @salary_cap - @consumedSalary()
  canAddPlayer: (player) ->
    @consumedSalary() + player.salary <= @salary_cap
  spotsTaken: ->
    (spot for spot in @entries when not not spot.player).length
  spotsLeft: ->
    (spot for spot in @entries when not spot.player).length
  averagePlayerSalary: ->
    (@consumedSalary()/@spotsTaken()) || 0
  averageRemainingPlayerSalary: ->
    remaining = @amountLeft() / @spotsLeft()
    if remaining == Infinity || remaining < 0
      return 0
    return remaining

  sortBy: (field, order) ->
    if @getNumberOfEntries() > 0
      if order == "desc"
        order = -1
      else
        order = 1
      @entries = @entries.sort (a, b) ->
        if a.player[field] < b.player[field]
          return (-1 * order);
        if a.player[field] > b.player[field]
          return (1 * order);
        return 0;
      return @entries
    else
      return []
  sortBySalary: (order) ->
    @sortBy("salary", order)

  sortByName: (order) ->
    @sortBy("name", order)
  clear: ->
    @entries.map (entry) ->
      entry.player = ''
    @updateView()
  updateView: ->
    @handleRedColor()
    $('tr.entry-item').find('td.val span').html '&nbsp;'

    accounting.settings.currency.format = {
      pos : "%s%v"
      neg : "-%s%v"
      zero: "%s%v"
    }

    settings = {
      symbol: "$"
      precision: 0
      thousand: ","
      decimal: "."
    }

    amountLeft = accounting.formatMoney(@amountLeft(), settings)
    $('#contest-salary-cap').html (amountLeft)
    averageRemaining = accounting.formatMoney(@averageRemainingPlayerSalary(), settings)
    $('#avg-rem-salary').html(averageRemaining)

    $.each @entries, (i, entry) ->
      entry.render()

  fixHeight: ->
    minHeight = $('div.capitalcontent').find('.same-height:first').height()
    $('div.capitalcontent').find('.same-height').each ->
      minHeight= Math.min minHeight, $(this).height()
    $('.same-height').css({height: minHeight+'px'})

$(document).on "ready page:load": ->
  window.Lineup = Lineup
