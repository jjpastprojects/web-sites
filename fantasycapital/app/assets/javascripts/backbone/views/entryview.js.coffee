class Main.Views.EntryView extends Backbone.View
  initialize: (args) ->
    @exists = true
    self = @
    @el = $(args.scorecardView.el).find(".scorecardHeader")
    @template = $("#entry-template").html()
    @entry = args.entry
    @entries_coll = args.entries_coll
    @listenTo(@entry, 'change', @changeentry)
    @listenTo(window.players_coll, 'change:currfps', @changeentry)
    @render()
  get_players_count: () ->
    stats = {}
    entries_coll.each( (entry, index) ->
      player_ids = entry.get_player_ids()
      _.each player_ids, (num) ->
        if !stats[num]
          stats[num] = 1
        else
          stats[num] += 1
    )
    return stats
  percent_owned: () ->
    players_count = @get_players_count()
    contestants_count = entries_coll.length
    for key, value of players_count
      players_count[key] = Math.round( (value / contestants_count) * 100)
    return players_count
  render: () ->
    # Look up the players for this entry
    if @exists
      player_and_pos = @entry.player_pos()
      # this part of code doesn't seem to be useful
      #$.each(player_and_pos,  (idx, pl_pos) ->
      #  if pl_pos[0].get('rtstats')
      #    console.log pl_pos[0].get('rtstats')
      #)
      $(@el).empty().html(_.template(this.template, {
        locals: globals,
        entry: @entry, 
        player_and_pos: player_and_pos, 
        user_img: window.user_img_placeholder,
        percentage: @percent_owned()
      }))
      $(@el).closest(".scorecard").show()
      return this
  changeentry: () ->
    @render()
  updateScoreAndStats: (player) ->
    node = $("tr[data-player-id=\"" + player.get("id") + "\"]")
    if node.length > 0
      score = node.find(".score")
      if score.length > 0
        score.html(player.get("currfps"))
      stats = node.find(".player-record")
      if stats.length > 0
        stats.html(player.get("rtstats"))
  clear: () ->
    @exists = false