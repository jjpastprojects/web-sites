# CRUD типов доставки
class Admin::DeliveryTypesController < Admin::BaseController
  # поддержка мультиязычности
  include MultilingualController
  before_action :set_delivery_type, only: [:show, :edit, :update, :destroy]

  # GET /delivery_types
  # GET /delivery_types.json
  def index
    @delivery_types = DeliveryType.all
  end

  # GET /delivery_types/1
  # GET /delivery_types/1.json
  def show
  end

  # GET /delivery_types/new
  def new
    @delivery_type = DeliveryType.new
  end

  # GET /delivery_types/1/edit
  def edit
  end

  # POST /delivery_types
  # POST /delivery_types.json
  def create
    @delivery_type = DeliveryType.new(delivery_type_params)

    respond_to do |format|
      if @delivery_type.save
        format.html { redirect_to admin_delivery_types_url, notice: 'Delivery type was successfully created.' }
        format.json { render action: 'show', status: :created, location: @delivery_type }
      else
        format.html { render action: 'new' }
        format.json { render json: @delivery_type.errors, status: :unprocessable_entity }
      end
    end
  end

  # PATCH/PUT /delivery_types/1
  # PATCH/PUT /delivery_types/1.json
  def update
    respond_to do |format|
      if @delivery_type.update(delivery_type_params)
        format.html { redirect_to admin_delivery_types_url, notice: 'Delivery type was successfully updated.' }
        format.json { head :no_content }
      else
        format.html { render action: 'edit' }
        format.json { render json: @delivery_type.errors, status: :unprocessable_entity }
      end
    end
  end

  # DELETE /delivery_types/1
  # DELETE /delivery_types/1.json
  def destroy
    @delivery_type.destroy
    respond_to do |format|
      format.html { redirect_to admin_delivery_types_url }
      format.json { head :no_content }
    end
  end

  def order
    errors = []

    if order_params
      order_params.each_with_index do |id, weight|
        item = DeliveryType.find id
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

  private
  # Use callbacks to share common setup or constraints between actions.
  def set_delivery_type
    @delivery_type = DeliveryType.find(params[:id])
  end

  def safe_params
    [:name, :price, :conditions, :is_active, :type, :layout, :hint, :payment_type_ids => []]
  end

  # Never trust parameters from the scary internet, only allow the white list through.
  def delivery_type_params
    permit_params
  end

  def order_params
    params.require(:order)
  end
end
