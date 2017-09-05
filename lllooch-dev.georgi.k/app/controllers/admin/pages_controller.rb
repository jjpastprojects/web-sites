# CRUD Контроллер страниц сайта
class Admin::PagesController < Admin::BaseController
  include MultilingualController
  
  before_action :set_page, only: [:show, :edit, :update, :destroy]
  after_action :reload_routes, only: [:create, :update]

  # GET /pages
  # GET /pages.json
  def index
    @pages = Page.all
  end

  # GET /pages/1
  # GET /pages/1.json
  def show
  end

  # GET /pages/new
  def new
    @page = Page.new
  end

  # GET /pages/1/edit
  def edit
  end

  # POST /pages
  # POST /pages.json
  def create
    @page = Page.new(page_params)

    respond_to do |format|
      if @page.save
        format.html { redirect_to admin_pages_url, notice: 'Page was successfully created.' }
        format.json { render action: 'show', status: :created, location: @page }
      else
        format.html { render action: 'new' }
        format.json { render json: @page.errors, status: :unprocessable_entity }
      end
    end
  end

  # PATCH/PUT /pages/1
  # PATCH/PUT /pages/1.json
  def update
    respond_to do |format|
      if @page.update(page_params)
        format.html { redirect_to admin_pages_url, notice: 'Page was successfully updated.' }
        format.json { head :no_content }
      else
        format.html { render action: 'edit' }
        format.json { render json: @page.errors, status: :unprocessable_entity }
      end
    end
  end

  # DELETE /pages/1
  # DELETE /pages/1.json
  def destroy
    @page.destroy
    respond_to do |format|
      format.html { redirect_to admin_pages_url }
      format.json { head :no_content }
    end
  end

  private
    # после каждого изменения страниц
    # необходимо перегружать все роуты,
    # а то новые страницы не появятся на сайте

    def reload_routes
      ContentRouter.reload
      CMS::Application.reload_routes!
    end
    
    # Use callbacks to share common setup or constraints between actions.
    def set_page
      @page = Page.find(params[:id])
    end

    def safe_params
      [:name, :page_type_id, :route, :title, :heading, :keywords, :description, :content, :url]
    end

    # Never trust parameters from the scary internet, only allow the white list through.
    def page_params
      permit_params
    end
end
