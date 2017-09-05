class LineupsController < ApplicationController
  before_filter :authenticate_user!
  before_action :set_lineup, only: [:edit, :update]

  def new
    @contest = Contest.includes(:eligible_players).find(params[:contest_id])
    @lineup  = Lineup.build_for_contest @contest
    populate_lineup_variables @lineup.sport
  end

  def edit
    @contest = @lineup.entries[0].contest
    @positions = SportPosition.where(sport: @lineup.sport, visible: true).order(display_priority: :asc)
    populate_lineup_variables @lineup.sport
    render action: 'new'

  end

  def result

  end

  def create
    # this is the POST request for creating a new lineup.
    contest_id = params[:lineup][:contest_id_to_enter]
    sport = params[:lineup][:sport]
    @lineup = current_user.lineups.new(lineup_parameters)
    # Create an entry that new lineup belongs to. Exception if user has too many entries in contest
    if @lineup.valid?
      begin
        @entry = Contest.find(@lineup.contest_id_to_enter).enter(@lineup) if @lineup.contest_id_to_enter.present?
      rescue RuntimeError, ActiveRecord::RecordInvalid => e
        redirect_to "/", alert: e.message
        return
      end
    end

    if @entry.nil? or !@lineup.valid?
      # error path
      @contest = Contest.includes(:eligible_players).find(contest_id)
      populate_lineup_variables sport
      flash.now[:alert] = @lineup.errors.full_messages.join ", "
      render action: 'new'
      return
    end

    # success path
    respond_to do |format|
      format.html { redirect_to entries_path, notice: "Congratulations. You have entered the contest." }
      format.json { render action: 'show', status: :created, location: @lineup }
    end
  end

  # PATCH /entries
  # PATCH /entries.json
  def update 
    #@lineup.contest = @contest ## Nils: This causes a bug, maybe it's outdated code?

    respond_to do |format|
      if @lineup.update(lineup_parameters)
        format.html { redirect_to lineups_path, notice: 'Lineup was successfully updated.' }
        format.json { render action: 'show', status: :created, location: @lineup }
      else
        @positions = @contest.sport_positions.includes(:players).order(display_priority: :asc)
        format.html { render action: 'edit' }
        format.json { render json: @entry.errors, status: :unprocessable_entity }
      end
    end
  end


  def index
    @lineups = current_user.lineups.includes([:lineup_spots]).order(updated_at: :desc).limit 3
  end

  def export
    render layout: false
  end

  private
  def set_lineup
    @lineup = Lineup.find(params[:id])
  end

  def lineup_parameters
    params.require(:lineup).permit(:contest_id_to_enter, :sport, lineup_spots_attributes: [:player_id, :id, :sport_position_id, :spot])
  end

  def populate_lineup_variables sport
    # fill out all the fields the lineup page (new / create / edit needs)
    @positions = SportPosition.where(sport: sport, visible: true).order(display_priority: :asc)
    # BUGBUG: definitely duplication here between positions and sportpositions
    @sportpositions = SportPosition.all
    @teams = Team.all
    @players = @contest.eligible_players.with_summary_fppg
    # select fields we want to display, making sure FPPG field is added.
    @players = @players.select('players.id', 'sport_position_id', 'salary', 'first_name',
                               'last_name', 'stat_value AS fppg', 'ext_player_id', 'team_id')
    @games = GameScore.where({playdate: @contest.contestdate})  # BUGBUG: is this used?

  end


end
