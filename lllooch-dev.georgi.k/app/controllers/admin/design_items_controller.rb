# Контроллер списка товаров дизайнера
# /designers/#{designer_id}/items
class Admin::DesignItemsController < Admin::BaseController
  include MultilingualController

  before_action :set_designer
  before_action :set_design_item, only: [:show, :edit, :update, :destroy]

  # GET /design_items
  # GET /design_items.json
  def index
    @design_items = DesignItem.all
  end

  # GET /design_items/1
  # GET /design_items/1.json
  def show
  end

  # GET /design_items/new
  def new
    @design_item = DesignItem.new
  end

  # GET /design_items/1/edit
  def edit
  end

  # POST /design_items
  # POST /design_items.json
  def create
    @design_item = DesignItem.new(design_item_params)
    @design_item.designer = @designer

    respond_to do |format|
      if @design_item.save
        format.html { redirect_to edit_admin_designer_url(@designer, anchor: "design_items"), notice: 'Design item was successfully created.' }
        format.json { render action: 'show', status: :created, location: @design_item }
      else
        format.html { render action: 'new' }
        format.json { render json: @design_item.errors, status: :unprocessable_entity }
      end
    end
  end

  # PATCH/PUT /design_items/1
  # PATCH/PUT /design_items/1.json
  def update
    respond_to do |format|
      if @design_item.update(design_item_params)
        format.html { redirect_to edit_admin_designer_url(@designer, anchor: "design_items"), notice: 'Design item was successfully updated.' }
        format.json { head :no_content }
      else
        format.html { render action: 'edit' }
        format.json { render json: @design_item.errors, status: :unprocessable_entity }
      end
    end
  end

  # DELETE /design_items/1
  # DELETE /design_items/1.json
  def destroy
    @design_item.destroy
    respond_to do |format|
      format.html { redirect_to edit_admin_designer_url(@designer, anchor: "design_items") }
      format.json { head :no_content }
    end
  end

  private
    # Use callbacks to share common setup or constraints between actions.
    def set_designer
      @designer = Designer.find(params[:designer_id])
    end

    def set_design_item
      @design_item = DesignItem.find(params[:id])
    end

    def safe_params
      [:name, :icon, :picture]
    end

    # Never trust parameters from the scary internet, only allow the white list through.
    def design_item_params
      permit_params
    end
end
