# CRUD категорий товаров
class Admin::GoodCategoriesController < Admin::BaseController
  include MultilingualController
  before_action :set_category, only: [:show, :edit, :update, :destroy, :order]

  # GET /categories
  # GET /categories.json
  def index
    @collections = GoodCategory.all
    @items = Good.all.to_a

    if params[:id]
      if params[:id] == 'main'
        @items.select! { |i| i.on_main }
      else
        @collection = GoodCategory.find(params[:id])
        @items = @items.delete_if { |i| i.good_category.select { |c| c == @collection }.empty? }.sort_by{|g| g.category_good_weight }
      end
    end
  end

  # GET /categories/1
  # GET /categories/1.json
  def show
  end

  # GET /categories/new
  def new
    @category = GoodCategory.new
  end

  # GET /categories/1/edit
  def edit
  end

  # POST /categories
  # POST /categories.json
  def create
    @category = GoodCategory.new(category_params)

    respond_to do |format|
      if @category.save
        format.html { redirect_to admin_good_categories_url, notice: 'GoodCategory was successfully created.' }
        format.json { render action: 'show', status: :created, location: @category }
      else
        format.html { render action: 'new' }
        format.json { render json: @category.errors, status: :unprocessable_entity }
      end
    end
  end

  # PATCH/PUT /categories/1
  # PATCH/PUT /categories/1.json
  def update
    respond_to do |format|
      if @category.update(category_params)
        format.html { redirect_to admin_good_categories_url, notice: 'GoodCategory was successfully updated.' }
        format.json { head :no_content }
      else
        format.html { render action: 'edit' }
        format.json { render json: @category.errors, status: :unprocessable_entity }
      end
    end
  end

  def order
    errors = []

    if order_params
      order_params.each_with_index do |id, weight|
        category_good = CategoryGood.find_or_initialize_by good_id: id, good_category_id: @category.id


        unless category_good.update(weight: weight)
          errors << category_good.errors
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

  # DELETE /categories/1
  # DELETE /categories/1.json
  def destroy
    @category.destroy
    respond_to do |format|
      format.html { redirect_to admin_good_categories_url }
      format.json { head :no_content }
    end
  end

  private
  # Use callbacks to share common setup or constraints between actions.
  def set_category
    @category = GoodCategory.find(params[:id])
  end

  def safe_params
    [:name, :slug, :parent_id, :title, :heading, :keywords, :description]
  end

  # Never trust parameters from the scary internet, only allow the white list through.

  def order_params
    params.require(:order)
  end

  def good_category_params
    category_params
  end

  def category_params
    permit_params
  end
end
