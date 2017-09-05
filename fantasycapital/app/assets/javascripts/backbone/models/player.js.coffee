class Main.Models.Player extends Backbone.Model
  debug: false
  defaults:
    0
  initialize: () ->
    if @debug
      console.log("initializing a player")
      @name()

  name: () ->
    if @debug
      console.log("invoking name -> name: " + @get("first_name") + " " + @get("last_name"));
    @get("first_name") + " " + @get("last_name")

  team: () ->
    if @debug
      console.log("invoking team -> team_id: " + @get("team_id"));
    if @collection
      return @collection.teams_coll.get(@get('team_id'))
    return null
  sportposition: () ->
    @collection.sportpositions_coll.get(@get('sport_position_id'))

  currgame: () ->
    # out of the games on this JS page, return the one he's playing in.
    team = @team()
    if @collection
      gamedate = @collection.contest.get('contestdate')
      games = []
      if team
        games = @collection.games_coll.where({away_team_id: team.id, playdate:gamedate}).concat(
                @collection.games_coll.where({home_team_id: team.id, playdate:gamedate}))
      if games.length > 1
        return games[0]
      if games.length == 0
        return null
      return games[0]
  getTeamID: () ->
    # this method points at the team in collection to ensure it's available
    if @team()
      return @team().id;
    return null
  getTeam: () ->
    mygame = @currgame()
    return "None" if !mygame
    return mygame.get_team_alias(@getTeamID())
  scorestring: () ->
    mygame = @currgame()
    return "None" if !mygame
    return mygame.score_string()
  teamsstring: () ->
    mygame = @currgame()
    return "None" if !mygame
    return mygame.home_team_alias() + "@" + mygame.away_team_alias()
  getHomeTeam: () ->
    mygame = @currgame()
    return "None" if !mygame
    return mygame.home_team_alias()
  getAwayTeam: () ->
    mygame = @currgame()
    return "None" if !mygame
    return mygame.away_team_alias()
  getHomeTeamScore: () ->
    mygame = @currgame()
    return "None" if !mygame
    return mygame.get("home_team_score") || "0"
  getAwayTeamScore: () ->
    mygame = @currgame()
    return "None" if !mygame
    return mygame.get("away_team_score") || "0"
  getMinutesRemaining: () ->
    mygame = @currgame()
    return "None" if !mygame
    minutes = mygame.get("game_remaining")
    if globals.sport == 'NBA'
      type = "MIN"
    else if globals.sport == 'MLB'
      type = "INN"
    return minutes + " " + type + " LEFT"
  getGameID: () ->
    mygame = @currgame()
    return 0 if !mygame
    return mygame.get("id")
  hasGameStarted: () ->
    mygame = @currgame()
    return false if !mygame
    return mygame.has_started()
  salarystring: () ->
    accounting.formatMoney(@get('salary'), {precision: 0});



class Main.Collections.PlayersCollection extends Backbone.Collection
  model: Main.Models.Player

  initialize: (models, args) ->
    @teams_coll = args.teams_coll
    @games_coll = args.games_coll
    @sportpositions_coll = args.sportpositions_coll
    @contest = args.contest



