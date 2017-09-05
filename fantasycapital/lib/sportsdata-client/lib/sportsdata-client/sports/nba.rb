module SportsdataClient
  module Sports
      class NBA < SportsdataClient::SportsdataGateway

        class << self

          def current_season
            season = (Time.now.month < 10) ? Time.now.year - 1 : Time.now.year
          end

          def teams(season= nil)
            client.request 'league/hierarchy.xml' do |response|
              SportsdataClient::ResponseParser.new(response).parse 'team'
            end
          end

          def players(ext_team_ids, season=current_season)
            teamhash = {}
            ext_team_ids.each do |ext_team_id|

              # Team profile (roster) API call
              client.request "teams/#{ext_team_id}/profile.xml" do |response|
                players = SportsdataClient::ResponseParser.new.parse('player', response)
                teamhash[ext_team_id] = players
              end

            end
            teamhash
          end

          def all_season_games(season=current_season)
            (self.regular_season_games + self.post_season_games )
          end

          def regular_season_games(season=current_season)
            games(season, 'REG')
          end

          def post_season_games(season=current_season)
            games(season, 'PST')
          end 

          def games(season, nba_season)
            client.request "games/#{season}/#{nba_season}/schedule.xml" do |response|
                SportsdataClient::ResponseParser.new(response).parse 'game'
            end
          end

          def full_game_stats(game_id, daily_scores)
            # NOTE: daily_scores arg not used for NBA games
            client.request "games/#{game_id}/summary.xml" do |response|
              fix_full_game_stats response
            end
          end

          def game_stats(game_id)
            client.request "games/#{game_id}/summary.xml" do |response|
                SportsdataClient::ResponseParser.new(response).parse 'team'
            end
          end

          def games_scheduled(date=Time.now.in_time_zone("EST").to_date)
            client.request "games/#{date.strftime("%Y/%m/%d")}/schedule.xml" do |response|
              SportsdataClient::ResponseParser.new(response).parse 'game'
            end
          end

          def fix_full_game_stats(response)
            case response['game']['status']
              # create default values of 'clock' and 'quarter' for games that haven't started
              when 'scheduled', 'created'
                response['game']['clock'] = "48"
                response['game']['quarter'] = "0"
            end
            response['game']

          end
          
          protected
          def action_prefix
            'nba-t3'
          end
        end
      end

    end
  end
