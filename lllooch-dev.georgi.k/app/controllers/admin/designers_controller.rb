# CRUD дизайнеров
class Admin::DesignersController < Admin::BaseController
  include MultilingualController
  
  before_action :set_designer, only: [:show, :edit, :update, :destroy]

  # GET /designers
  # GET /designers.json
  def index
    @designers = Designer.all
  end

  # GET /designers/1
  # GET /designers/1.json
  def show
  end

  # GET /designers/new
  def new
    @designer = Designer.new
  end

  # GET /designers/1/edit
  def edit
  end

  # POST /designers
  # POST /designers.json
  def create
    @designer = Designer.new(designer_params)

    respond_to do |format|
      if @designer.save
        format.html { redirect_to admin_designers_url, notice: 'Designer was successfully created.' }
        format.json { render action: 'show', status: :created, location: @designer }
      else
        format.html { render action: 'new' }
        format.json { render json: @designer.errors, status: :unprocessable_entity }
      end
    end
  end

  def order
    errors = []

    if order_params
      order_params.each_with_index do |id, weight|
        good = Designer.find id
        good.weight = weight

        unless good.save :validate => false
          errors << good.errors
        end
      end
    end

    respond_to do |format|
      if errors.empty?
        format.json { head :no_content }
      else
        format.json { render json: errors, status: :unprocessable_entity }
      end
    end
  end

  # PATCH/PUT /designers/1
  # PATCH/PUT /designers/1.json
  def update
    respond_to do |format|
      if @designer.update(designer_params)
        format.html { redirect_to admin_designers_url, notice: 'Designer was successfully updated.' }
        format.json { head :no_content }
      else
        format.html { render action: 'edit' }
        format.json { render json: @designer.errors, status: :unprocessable_entity }
      end
    end
  end

  # DELETE /designers/1
  # DELETE /designers/1.json
  def destroy
    @designer.destroy
    respond_to do |format|
      format.html { redirect_to admin_designers_url }
      format.json { head :no_content }
    end
  end

  private
    # Use callbacks to share common setup or constraints between actions.
    def set_designer
      @designer = Designer.find(params[:id])
    end

    def safe_params
      [:name, :title, :heading, :keywords, :description, :content, :avatar, :motto]
    end

    # Never trust parameters from the scary internet, only allow the white list through.
    def designer_params
      permit_params
    end

    def order_params
      params.require(:order)
    end
end
