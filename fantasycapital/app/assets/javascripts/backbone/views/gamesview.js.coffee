class Main.Views.GamesView extends Backbone.View

  initialize: (args) ->
    @template = $("#games-template").html()
    @games_coll = args.games_coll
#    @listenTo(@games_coll, 'add', @addGame)
#    @listenTo(@games_coll, 'reset', @resetGames)
    @listenTo(@games_coll, 'change', @changeGames)
    @render()

  render: () ->
    gamestoday = @games_coll.where({playdate: contest.get('contestdate')})
    $(@el).html(_.template(@template, {games: gamestoday}))
    return this

  changeGames: () ->
    @render()
#  resetGames: () ->
#    console.log "RESET GAMES"
#
#  addGame: () ->
#    console.log "ADD GAME"