# Список предзаказов и удаление
class Admin::PreordersController < Admin::BaseController
  before_action :set_order, only: [:show, :destroy]

  # GET /orders
  # GET /orders.json
  def index
    @orders = Order::Preorder.all
  end

  # DELETE /orders/1
  # DELETE /orders/1.json
  def destroy
    if @order.update(order_status: OrderStatus::Canceled.first)
      respond_to do |format|
        format.html { redirect_to admin_preorders_url }
        format.json { head :no_content }
      end
    end
  end

  private
  # Use callbacks to share common setup or constraints between actions.
  def set_order
    @order = Order::Preorder.find(params[:id])
  end
end
