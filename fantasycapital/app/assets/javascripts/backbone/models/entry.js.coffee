class Main.Models.Entry extends Backbone.Model
  paramRoot: 'entry'
  urlRoot: '/api/gc_data2/'
  defaults:
    name: 'Foo'
    id: 0
    lineup_spots: []
    player_ids: []

  initialize: () ->
    0

  player_pos: () ->
    # return player model instances and the position they are playing in for this Entry
    _.map( @get('player_ids'),  (playerid_posid) -> [players_coll.get(playerid_posid[0]), playerid_posid[1]] )

  players: () ->
    # return player model instances  for this Entry
    _.map( @get('player_ids'),  (playerid_posid) -> players_coll.get(playerid_posid[0]) )
  get_all_scores: () ->
    _.map(@players(), (player) -> parseFloat(player.get("currfps")))
  get_total_score: () ->
    _.reduce(@get_all_scores(), ((memo, num) -> memo + num), 0) || 0
  get_player_ids: () ->
    _.map( @get("player_ids"), (player) -> player[0] )
  get_game_ids: () ->
    ids = []
    players = @players()
    if players
      $.each(players, (index, player) ->
        game = player.currgame()
        if game
          ids.push(game.get("id"))
      )
    return _(ids).uniq()
  sum_game_property: (property) ->
    left = 0
    players = @players()
    if players
      $.each(players, (index, player) ->
        game = player.currgame()
        if game
          left += game.get(property)
      )
    return left
  min_left: () ->
    @sum_game_property('game_remaining')
  total_gamelength: () ->
    @sum_game_property('gamelength')
class Main.Collections.EntriesCollection extends Backbone.Collection
  model: Main.Models.Entry
  url: '/entries'

  # provide comparator so that sort returns fantasy points in descending order
  comparator: (model) ->
    return -parseFloat(model.get_total_score())

