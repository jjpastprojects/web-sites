module SportsdataClient
  module Sports
      class MLB < SportsdataClient::SportsdataGateway

        class << self

          def current_season
            # MLB season runs from April thru Sept in regular season, Oct post-season.
            season = Time.now.year
          end

          def teams(season=current_season)
            teams=client.request "teams/#{season}.xml" do |response|
              SportsdataClient::ResponseParser.new(response).parse 'team'
            end
            process_mlb_teams teams

          end

          def players(ext_team_ids, season=current_season)
            # NOTE: in MLB, 'ext_team_ids' variable is unused b/c the API returns all teams
            # regardless, while in NBA we have to make an API call per team.
            # return a hash of external team ids, with each entry an array of parsed players
            players={}
            client.request "rosters/#{season}.xml" do |response|
              teams_parsed=SportsdataClient::ResponseParser.new(response).parse 'team'

              teams_parsed.each do |team_parsed|
                # parse out 'player' nodes from each team.
                players_parsed = SportsdataClient::ResponseParser.new
                players[team_parsed['id']] = players_parsed.parse('player', team_parsed)
              end
            end
            players
          end

          def all_season_games(season=current_season)
            events = client.request "schedule/#{season}.xml" do |response|
              SportsdataClient::ResponseParser.new(response).parse 'event'
            end
            process_mlb_events events
          end

          def daily_scores(date)
            url =  "daily/boxscore/%04d/%02d/%02d.xml" % [date.year, date.month, date.day]
            client.request url
          end

          def full_game_stats(game_id, daily_scores)
            #client.request "games/#{game_id}/summary.xml"
            client.request "statistics/#{game_id}.xml" do |response|
              # build up response as expected by API:
              #   - id
              #   - team (array of hometeam, away team)
              #       - points
              #       - ['players']['player'] -- array of players
              retval = response['statistics']
              retval['team'] = [fix_team_stats(retval['home']), fix_team_stats(retval['visitor']) ]
              currscores = daily_scores['boxscores']['boxscore'].find{|e| e['id'] == game_id}
              begin
                if currscores['status'] == 'closed'
                  retval['inning'] = currscores['final']['inning']
                  retval['inning_half'] = currscores['final']['inning_half']
                elsif currscores['status'] == 'scheduled'
                  retval['inning'] = 0
                  retval['inning_half'] = 'T'
                else
                  retval['inning'] = currscores['outcome']['current_inning']
                  retval['inning_half'] = currscores['outcome']['current_inning_half']
                end
              rescue
                Rails.logger.error "Can't find final or outcome fields in currscores: #{currscores}"
                # when we've hit this in the past, it means there's another if (status) that
                # we need to implement above.
              end

              retval
            end
          end

          def game_stats(ext_game_id)
            # Get "Game Summary" from API
            # For Projection, this needs to return array of length 2, each entry is a “team” hash:
            #id — team ID
            #[players][player]
            #    [played]
            #    [id] (player ID)
            #    [statistics]
            #        [stat1]
            #        [stat2]
            result = client.request "statistics/#{ext_game_id}.xml"
            hometeamstats = result['statistics']['home']
            awayteamstats = result['statistics']['visitor']

            # adjust parameters to match receiver's expectations
            [hometeamstats,awayteamstats].each do |team_src|
              fix_team_stats(team_src)
            end
            # return home and away team, similar format as NBA API does natively.
            teamresp = [hometeamstats, awayteamstats]

            return teamresp

          end

          def games_scheduled(date=Time.now.in_time_zone("EST").to_date)
            url =  "daily/schedule/%04d/%02d/%02d.xml" % [date.year, date.month, date.day]
            events = client.request url do |response|
              SportsdataClient::ResponseParser.new(response).parse 'event'
            end
            process_mlb_events events
          end
          
          protected
          def action_prefix
            'mlb-t4'
          end

          def process_mlb_teams(teams)
            # take teams coming from the sports-data API for MLB,
            # and adjust their fields so the rest of the app understands them
            teams.each do |team|
              team['alias'] = team['abbr']
            end
            return teams
          end
          def process_mlb_events(events)
            # take events (aka games)coming from the sports-data games API for MLB,
            # and adjust their fields so the rest of the app understands them
            events.each do |event|
              event['scheduled'] = event['scheduled_start']
              event['home_team'] = event['home']
              event['away_team'] = event['visitor']
            end
            return events
          end

          private
          def fix_team_stats(team_src)

            # playerlist can be empty if this is a scheduled game... if so, stub out the datastruct
            team_src['hitting']['players'] = {'player' => []} if team_src['hitting']['players'].nil?

            # playerlist can be a hash if there's a single player, while it's an
            #   an array if there are multiple players. (Bad API!) Clean that up.
            if team_src['hitting']['players']['player'].kind_of?(Hash)
              team_src['hitting']['players']['player'] = [team_src['hitting']['players']['player']]
            end

            playerlist = team_src['hitting']['players']['player']
            playerlist.each do |player|
              # BUGBUG: PITCHER IS MISSING HERE, NEED TO ADD hometeamstats['pitching]['players']
              # BUGBUG: player['games'] doesn't exist in realtime? It exists in projection:fetch_stats???
              begin
                player['played'] = 'false'
                player['played'] = 'true' if player['games']['play'].to_i > 0
              rescue NoMethodError => e
                # this exception occurs when we didn't find player['games'].
                #  It looks like this is normal for in-progress MLB games. In that case I think
                #  the player list is only folks who are actually playing, so we can mark the
                #  player's 'played' attribute true.
                #Rails.logger.warn "Player missing 'played' field: #{player['id']}, " +
                #                   "team #{team_src['id']}"
                player['played'] = 'true' # make assumption to recover...
              end

              player['statistics'] = {}

              # Add "onbase" statistics -- single, double, triple, homerun, base-on-balls,
              #   hit-by-pitch
              ['s', 'd', 't', 'hr', 'bb', 'hbp'].each do |statname|
                player['statistics'][statname] = player['onbase'][statname]
              end
              # Append other stats
              player['statistics']['runs'] = player['runs']['total']  # total runs
              player['statistics']['rbi'] = player['rbi']             # RBI
              player['statistics']['ktotal'] = player['outs']['ktotal'] # strikeouts
              player['statistics']['stolen'] = player['steal']['stolen'] # stolen bases

            end
            team_src['points'] = team_src['runs']
            # BUGBUG: need to add pitcher here...
            team_src['players'] = team_src['hitting']['players']

            team_src

          end

        end
      end

    end
  end
