class StatService
  # Stats service generates the data for the statistics user interface.
    def initialize
      @stat_map = { 
        "fp" => "FPPG",
        "personal_fouls" => "PFPG",
        "minutes" => "MPG",
        "points" => "PPG",
        "assists" => "APG",
        "steals" => "STLPG",
        "rebounds" => "RPG",
        "blocks" => "BLKPG",
        "turnovers" => "TOPG",
      }
      @dimension_map = {
        "p_player." => "summary",
      }
      @span_map = {
        "the_0th_game_to_last" => lambda {|games| games[0].start_date.strftime("%m/%d") },
        "the_1rd_game_to_last" => lambda {|games| games[0].start_date.strftime("%m/%d") },
        "the_2nd_game_to_last" => lambda {|games| games[0].start_date.strftime("%m/%d") },
        "home_games" => lambda {|games| "Home Games"},
        "away_games" => lambda {|games| "Away Games"},
        "all_games" => lambda {|games| "2013 season"}
      }

    end
  
    def update_player_stats(scheduled_game)
      [[scheduled_game.home_team, scheduled_game.away_team], [scheduled_game.away_team, scheduled_game.home_team]].each do |(team1, team2)|
        team1.players.each do |p_player|
          player = Player.where(ext_player_id: p_player.ext_player_id).first
          next if player.nil?
          player.player_stats.delete_all
          # BUGBUG: Need to pass SPORT here so we can get it right in update_stats
          update_stats(player, p_player)
        end # of player
      end # of team
    end

    def update_stats(player, p_player)
      cal = Projection::FantasyPointCalculator.create_for_sport('NBA')
      @dimension_map.each do |subject, dim_display|
        priority=0
        @span_map.each do |span, span_display|
          priority+=1
          @stat_map.each do |stat_name, stat_display|
            games = eval(subject + span)
            next if games.nil? || games.size == 0
            stat_value = cal.avg_stats_per_game(games) {|stat| stat.stat_name == stat_name && stat.player == p_player}
            PlayerStat.create(dimension: dim_display, time_span: span_display.call(games), stat_name: stat_display, stat_value: stat_value.to_s, player: player, display_priority: priority)
          end # of stat
        end # of span
      end # of dim
    end

end
