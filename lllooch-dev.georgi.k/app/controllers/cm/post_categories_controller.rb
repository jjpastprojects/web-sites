# CRUD категорий постов
class Cm::PostCategoriesController < Cm::BaseController
  include MultilingualController
  before_action :set_category, only: [:show, :edit, :update, :destroy]

  # GET /categories
  # GET /categories.json
  def index
    @collections = PostCategory.all
    @items = Post.all

    if params[:id]
      @collection = PostCategory.find(params[:id])
      
      @items = @collection.posts
    end
  end

  # GET /categories/1
  # GET /categories/1.json
  def show
  end

  # GET /categories/new
  def new
    @category = PostCategory.new
  end

  # GET /categories/1/edit
  def edit
  end

  # POST /categories
  # POST /categories.json
  def create
    @category = PostCategory.new(category_params)

    respond_to do |format|
      if @category.save
        format.html { redirect_to cm_post_categories_url, notice: 'PostCategory was successfully created.' }
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
        format.html { redirect_to cm_post_categories_url, notice: 'PostCategory was successfully updated.' }
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
        item = PostCategory.find id
        item.weight = weight

        unless item.save :validate => false
          errors << item.errors
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
      format.html { redirect_to cm_post_categories_url }
      format.json { head :no_content }
    end
  end

  private
    # Use callbacks to share common setup or constraints between actions.
    def set_category
      @category = PostCategory.find(params[:id])
    end

    def safe_params
      [:name, :slug, :parent_id, :title, :heading, :keywords, :description]
    end

    # Never trust parameters from the scary internet, only allow the white list through.
    def post_category_params
      category_params
    end

    def category_params
      permit_params
    end

    def order_params
      params.require(:order)
    end
end
