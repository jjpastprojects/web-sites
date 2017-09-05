# Watch DOM elements with "player-stats" class. On a click of such an  element,
# bring up a modal dialog with the player's detailed stats.
# The DOM element must contain a data attrib like data-stats-url="/players/2331/stats"

# to use the class, call new PlayerStats() once the DOM is populated.

class PlayerStats
  id: ''
  name: ''
  salary: 0
  opp: ''
  fppg: ''
  position: ''

  constructor: (dom) ->
    if dom?
      @id           = dom.data('player-id') || ""
      @name         = dom.data('player-name') || ""
      @salary       = dom.data('player-salary') || ""
      @opp          = dom.data('player-opp') || ""
      @fppg         = dom.data('player-fppg') || ""
      @position     = dom.data('player-position') || ""
      @homeTeam     = dom.find(".home-team").text() || ""
      @opponentTeam = dom.find(".opponent-team").text() || ""


window.PlayerStats = PlayerStats


