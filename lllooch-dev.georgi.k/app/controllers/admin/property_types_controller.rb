# CRUD типов свойств товаров
class Admin::PropertyTypesController < Admin::BaseController
  include MultilingualController
  before_action :set_property_type, only: [:show, :edit, :update, :destroy]

  # GET /property_types
  # GET /property_types.json
  def index
    @property_types = PropertyType.all
  end

  # GET /property_types/1
  # GET /property_types/1.json
  def show
  end

  # GET /property_types/new
  def new
    @property_type = PropertyType.new
  end

  # GET /property_types/1/edit
  def edit
  end

  # POST /property_types
  # POST /property_types.json
  def create
    @property_type = PropertyType.new(property_type_params)

    respond_to do |format|
      if @property_type.save
        format.html { redirect_to admin_property_types_url, notice: 'Property type was successfully created.' }
        format.json { render action: 'show', status: :created, location: @property_type }
      else
        format.html { render action: 'new' }
        format.json { render json: @property_type.errors, status: :unprocessable_entity }
      end
    end
  end

  # PATCH/PUT /property_types/1
  # PATCH/PUT /property_types/1.json
  def update
    respond_to do |format|
      if @property_type.update(property_type_params)
        format.html { redirect_to admin_property_types_url, notice: 'Property type was successfully updated.' }
        format.json { head :no_content }
      else
        format.html { render action: 'edit' }
        format.json { render json: @property_type.errors, status: :unprocessable_entity }
      end
    end
  end

  # DELETE /property_types/1
  # DELETE /property_types/1.json
  def destroy
    @property_type.destroy
    respond_to do |format|
      format.html { redirect_to admin_property_types_url }
      format.json { head :no_content }
    end
  end

  private
    # Use callbacks to share common setup or constraints between actions.
    def set_property_type
      @property_type = PropertyType.find(params[:id])
    end

    def safe_params
      [:name]
    end

    # Never trust parameters from the scary internet, only allow the white list through.
    def property_type_params
      permit_params
    end
end
