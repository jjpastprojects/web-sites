# CRUD опций товара, по которому определялись критерии варианта (с юсб/без юсб, цвет и тд.)
# больше не используется
# TODO safe_delete
class Admin::GoodOptionsController < Admin::BaseController
  include MultilingualController
  before_action :set_good_option, only: [:show, :edit, :update, :destroy]
  before_action :set_good, only: [:new, :edit, :create, :update, :destroy]

  # GET /good_options
  # GET /good_options.json
  def index
    @good_options = GoodOption.all
  end

  # GET /good_options/1
  # GET /good_options/1.json
  def show
  end

  # GET /good_options/new
  def new
    @good_option = GoodOption.new
    @good_option.good = @good
  end

  # GET /good_options/1/edit
  def edit
  end

  # POST /good_options
  # POST /good_options.json
  def create
    @good_option = GoodOption.new(good_option_params)
    @good_option.good = @good

    respond_to do |format|
      if @good_option.save
        format.html { redirect_to edit_admin_good_url(@good, anchor: "options"), notice: 'Good option was successfully created.' }
        format.json { render action: 'show', status: :created, location: @good_option }
      else
        format.html { render action: 'new' }
        format.json { render json: @good_option.errors, status: :unprocessable_entity }
      end
    end
  end

  # PATCH/PUT /good_options/1
  # PATCH/PUT /good_options/1.json
  def update
    respond_to do |format|
      if @good_option.update(good_option_params)
        format.html { redirect_to edit_admin_good_url(@good, anchor: "options"), notice: 'Good option was successfully updated.' }
        format.json { head :no_content }
      else
        format.html { render action: 'edit' }
        format.json { render json: @good_option.errors, status: :unprocessable_entity }
      end
    end
  end

  # DELETE /good_options/1
  # DELETE /good_options/1.json
  def destroy
    @good_option.destroy
    respond_to do |format|
      format.html { redirect_to edit_admin_good_url(@good, anchor: "options") }
      format.json { head :no_content }
    end
  end

  private
    # Use callbacks to share common setup or constraints between actions.
    def set_good_option
      @good_option = GoodOption.find(params[:id])
    end

    def safe_params
      [:name, :price, :good_id]
    end

    # Never trust parameters from the scary internet, only allow the white list through.
    def good_option_params
      permit_params
    end

    def set_good
      if @good_option.nil?
        @good = Good.find(params[:good_id] || good_option_params[:good_id])
      else
        @good = @good_option.good
      end
    end
end
