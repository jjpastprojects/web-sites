# Render the table of players on the "new lineup" page
class Main.Views.LineupPlayerView extends Backbone.View

  initialize: (args) ->
    @template = $("#lineup-player-template").html()
    @players_coll = args.players_coll
    @render()

  render: () ->

    $(@el).html(_.template(@template, {players: @players_coll}))
    return this
