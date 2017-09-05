
class Entry
  player: ""
  position: ""
  spot: ""

  constructor: (dom) ->
    @position = dom.data('sport-position-name') || ""
    @spot     = dom.data('spot') || ""
    @player   = ""
    player_id = dom.data('player-id') || ""

    if player_id?
      player_dom = $('tr.contest-player[data-player-id="' + player_id + '"]')
      if player_dom.length
        @player = new window.PlayerStats(player_dom)
        player_dom.hide()
    @spot = dom.data('spot')

  addPlayer: (player) ->
    if player instanceof PlayerStats
      @.player = player
    else
      return null
  getPlayer: ->
    @.player
  removePlayer: ->
    @.player = ""
  playerExists: ->
    @.player != ""
  playerTeams: ->
    # no templates are used in this case yet, maybe this piece of functionality should be refactored a little?
    if !@player || !@player.opp
      return ""
    a = @player.opp.split("@")
    if a.length > 0
      if a[0] == @player.homeTeam
        return "<strong class=\"home-team\">" + @player.homeTeam + "</strong>" + "@" + @player.opponentTeam
      else
        return @player.opponentTeam + "@" + "<strong class=\"home-team\">" + @player.homeTeam + "</strong>"
    return ""
  formatFPPG: ->
    if typeof @player.fppg == "undefined"
      return "&nbsp";
    if @player.fppg && (typeof @player.fppg == "string" || typeof @player.fppg == "number") && !isNaN(@player.fppg)
      return @player.fppg.toFixed(1)
    else
      return "0"
  render: ->
    that = @
    settings = {
      symbol: "$"
      precision: 0
      thousand: ","
      decimal: "."
    }

    dom = $("tr.lineup-spot[data-spot="+ @spot+"]")
    dom.find('td.player input').attr("value", that.player.id) 
    dom.find('td.player span').html @player.name || ""
    dom.find('td.opp span').html @playerTeams() || "&nbsp;"
    if @player.salary
      salary = accounting.formatMoney(@player.salary, settings)
    else
      salary = "&nbsp;"
    dom.find('td.salary span').html salary 
    dom.find('td.fppg span').html @formatFPPG()
    if @player.id
      dom.find('td.player-stats').attr('data-stats-url', '/players/' + that.player.id + '/stats')
      dom.find('td.player-stats').addClass("pointer")
    else
      dom.find('td.player-stats').removeClass("pointer")

$(document).on "ready page:load": ->
  window.Entry = Entry
