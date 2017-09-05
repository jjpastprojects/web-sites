class EntriesController < ApplicationController
  # before_action :set_lineup, only: [:new, :create]
  before_action :check_authorized_entry, only: [:show, :edit]
  def new
    #@positions = @contest.sport_positions.includes(:players).order(display_priority: :asc)
    #@entry     = Entry.build_entry_for_contest @contest
  end

  def edit
  end

  def admin
    # functions that a site admin can do (some might be only pre-launch)
    if params['command'] == "Make Live"
      # adjust this contest's start time to make it live, and execute captured data via resque
      @entry = Entry.find(params[:id])
      Resque.enqueue(GamePlaybackWorker, params[:id])
      render nothing: true

    end
  end

  def show
    # this is the real-time "gamecenter" action. It shows a contest from a particular
    # day.
    @entry_id = params[:id]
    @contest = @entry.contest
    @entries = @entry.contest.entries

    #@games = GameScore.recent_and_upcoming  # BUGBUG: do we need this? or just today's games?

    # get all the player scores for today's games
    @todaysgames = GameScore.where(playdate: @contest.contestdate, sport: @contest.sport)

    @teams = Team.all  # BUGBUG: this is not subsetted to sport... do we need to do that?

    # add today's scores to the players in a consumable format.
    todaygameids = @todaysgames.pluck('id')
    rawplayers = Player.includes(:player_real_time_scores).where(
                                    player_real_time_scores: {game_score_id: todaygameids})
    @players = rawplayers.map { |player|
      pl_json = player.as_json()
      pl_json['rtstats'] = player.rtstats(@contest.sport)
      pl_json['currfps'] = player.realtime_fantasy_points
      pl_json
    }
    @sportpositions = SportPosition.where(sport: @contest.sport)
  end

  def index
    # seeding the data object
    todaydate = Time.now.in_time_zone("US/Pacific").to_date

    liveContests = []
    upcomingContests = []
    completedContests = []

    entries_in_play = current_user.entries.in_range(
                            todaydate-7,
                            # show fake contests to admins only
                            current_user.admin ? Time.new(2060,1,1) : todaydate+7).
                        includes({contest: :entries}).includes(:lineup)

    entries_in_play.each do |entry|
      # the API has a funky format, close to a contest but not quite. Build up an element for it.
      contest = entry.contest.attributes
      contest['results_path'] = entry_path(entry)
      contest['view_path'] = entry_path(entry)
      contest['edit_path'] = edit_lineup_path(entry.lineup)

      # determine which list the entry goes on by its contest's state.
      state = entry.contest.accurate_state
      if state == :closed
        contest['final_pos'] = entry[:final_pos]
        completedContests << contest
      elsif state == :live
        contest['final_pos'] = entry.current_pos
        contest['num_entries'] = entry.contest.entries.count
        liveContests << contest
      end

      upcomingContests << contest if state == :in_future
    end

    @data = {
      liveContests: liveContests, 
      upcomingContests: upcomingContests,
      completedContests: completedContests
    }

    
  end

  # POST /entries
  # POST /entries.json
  def create
    entry = current_user.entries.build lineup: @lineup
    message = if entry.save
                "Your entry is submitted successfully!"
              else
                entry.errors.full_messages.first
              end
    redirect_to lineups_path, notice: message
    #respond_to do |format|
    # if @entry.save
    #   format.html { redirect_to [@contest, @entry], notice: 'Entry was successfully created.' }
    #   format.json { render action: 'show', status: :created, location: @entry }
    # else
    #   format.html { render action: 'new' }
    ##   format.json { render json: @entry.errors, status: :unprocessable_entity }
    # end
  end

  private
    def check_authorized_entry
      @entry = current_user.entries.find(params[:id])
    rescue ActiveRecord::RecordNotFound
      redirect_to root_path unless current_user.admin
      @entry = Entry.find(params[:id])
    end
    # def set_lineup
    #   @lineup = Lineup.find(params[:lineup_id])
    # end

    #def entry_parameters
    #  params.require(:entry).permit(:contest_id, lineups_attributes: [:sport_position_id, :player_id])
    #end

end
