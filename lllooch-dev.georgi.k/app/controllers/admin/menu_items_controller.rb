# CRUD элементов меню
class Admin::MenuItemsController < Admin::BaseController
  include MultilingualController
  
  before_action :set_menu_item, only: [:show, :edit, :update, :destroy]
  before_action :set_menu, except: [:order]
  # before_action :order_params, only: [:order]

  # GET /menu_items
  # GET /menu_items.json
  def index
    if @menu
      @menu_items = @menu.items
    else
      @menu_items = MenuItem.all
    end
  end

  # GET /menu_items/1
  # GET /menu_items/1.json
  def show
  end

  # GET /menu_items/new
  def new
    @menu_item = MenuItem.new
  end

  # GET /menu_items/1/edit
  def edit
  end

  # POST /menu_items
  # POST /menu_items.json
  def create
    @menu_item = MenuItem.new(menu_item_params)
    @menu_item.menu = @menu

    respond_to do |format|
      if @menu_item.save
        format.html { redirect_to admin_menu_menu_items_url, notice: 'Menu item was successfully created.' }
        format.json { render action: 'show', status: :created, location: @menu_item }
      else
        format.html { render action: 'new' }
        format.json { render json: @menu_item.errors, status: :unprocessable_entity }
      end
    end
  end

  def order
    errors = []

    if order_params
      # сортировка элементов меню
      # приходит массив с айдишниками элементов вида [3, 5, 8, 10],
      # которым потом проставляется порядковый номер
      order_params.each_with_index do |id, weight|
        menu_item = MenuItem.find id
        menu_item.weight = weight

        unless menu_item.save
          errors << menu_item.errors
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

  # PATCH/PUT /menu_items/1
  # PATCH/PUT /menu_items/1.json
  def update
    respond_to do |format|
      if @menu_item.update(menu_item_params)
        format.html { redirect_to admin_menu_menu_items_url, notice: 'Menu item was successfully updated.' }
        format.json { head :no_content }
      else
        format.html { render action: 'edit' }
        format.json { render json: @menu_item.errors, status: :unprocessable_entity }
      end
    end
  end

  # DELETE /menu_items/1
  # DELETE /menu_items/1.json
  def destroy
    @menu_item.destroy
    respond_to do |format|
      format.html { redirect_to admin_menu_menu_items_url }
      format.json { head :no_content }
    end
  end

  private
    # Use callbacks to share common setup or constraints between actions.
    def set_menu_item
      @menu_item = MenuItem.find(params[:id])
    end

    def set_menu
      @menu = Menu.find(params[:menu_id])
    end

    def safe_params
      [:name, :page_id, :url, :title, :menu_item_id]
    end

    # Never trust parameters from the scary internet, only allow the white list through.
    def menu_item_params
      permit_params
    end

    def order_params
      params.require(:order)
    end
end
