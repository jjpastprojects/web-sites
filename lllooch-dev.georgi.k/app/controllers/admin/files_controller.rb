# CRUD файлов товара
class Admin::FilesController < Admin::BaseController
  include MultilingualController

  before_action :set_file, only: [:show, :edit, :update, :destroy]
  before_action :set_good, only: [:new, :edit, :create, :update, :destroy]
  

  # GET /pdfs
  # GET /pdfs.json
  def index
    @files = GoodFile.all
  end

  # GET /pdfs/1
  # GET /pdfs/1.json
  def show
  end

  # GET /pdfs/new
  def new
    @file = GoodFile.new
    @file.good = @good
  end

  # GET /pdfs/1/edit
  def edit
  end

  # POST /pdfs
  # POST /pdfs.json
  def create
    @file = GoodFile.new(file_params)
    @file.good = @good

    respond_to do |format|
      if @file.save
        format.html { redirect_to edit_admin_good_url(@good, anchor: "files"), notice: 'File was successfully created.' }
        format.json { render action: 'show', status: :created, location: @file }
      else
        format.html { render action: 'new' }
        format.json { render json: @file.errors, status: :unprocessable_entity }
      end
    end
  end

  def order
    errors = []

    #abort order_params.to_s

    if order_params
      order_params.each_with_index do |id, weight|
        item = GoodFile.find id
        item.weight = weight

        unless item.save
          #abort item.id.to_s
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

  # PATCH/PUT /pdfs/1
  # PATCH/PUT /pdfs/1.json
  def update
    respond_to do |format|
      if @file.update(file_params)
        format.html { redirect_to edit_admin_good_url(@good, anchor: "files"), notice: 'File was successfully updated.' }
        format.json { head :no_content }
      else
        format.html { render action: 'edit' }
        format.json { render json: @file.errors, status: :unprocessable_entity }
      end
    end
  end

  # DELETE /pdfs/1
  # DELETE /pdfs/1.json
  def destroy
    @good = @file.good

    @file.destroy
    respond_to do |format|
      format.html { redirect_to edit_admin_good_url(@good, anchor: "files") }
      format.json { head :no_content }
    end
  end

  private
    # Use callbacks to share common setup or constraints between actions.
    def set_file
      @file = GoodFile.find(params[:id])
    end

    def set_good
      if @file.nil?
        @good = Good.find(params[:good_id] || file_params[:good_id])
      else
        @good = @file.good
      end
    end

    def safe_params
      [:name, :src, :good_id, :type]
    end

    # Never trust parameters from the scary internet, only allow the white list through.
    def file_params
      permit_params
    end

    def order_params
      params.require(:order)
    end
end
