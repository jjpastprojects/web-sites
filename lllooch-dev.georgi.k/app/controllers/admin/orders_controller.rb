# Список и удаление заказов
class Admin::OrdersController < Admin::BaseController
  before_action :set_order, only: [:show, :destroy]

  # GET /orders
  # GET /orders.json
  def index
    @orders = Order::Robust.all
  end

  # DELETE /orders/1
  # DELETE /orders/1.json
  def destroy
    if @order.update!(order_status: OrderStatus::Canceled.first)
      respond_to do |format|
        format.html { redirect_to admin_orders_url }
        format.json { head :no_content }
      end
    else
      redirect_to admin_orders_url
    end
  end

  private
    # Use callbacks to share common setup or constraints between actions.
    def set_order
      @order = Order::Robust.find(params[:id])
    end
end
