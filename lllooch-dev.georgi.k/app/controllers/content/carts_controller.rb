# Контроллер корзины
# вся логика описана в моделях, тут обычные crud-действия
class Content::CartsController < Content::BaseController
  layout 'content'

  before_action :check
  before_action :set_good, only: [:buy]

  def index
  end

  def delivery
    delivery_type = DeliveryType.find(delivery_params[:delivery_type])
    delivery = delivery_type.calculate(@cart, delivery_params)

    unless delivery_type.errors.present?
      render json: delivery.to_json
    else
      #
      render json: { errors: delivery_type.errors[:calculate] }.to_json
    end
  end

  def buy

    order_good = @cart.items.where(good_id: @good.id).first


    if order_good.present?
      order_good.quantity += 1

      if @good.name.downcase == 'starwire'
        order_good.price = 3360
      end

      order_good.save
    else

      if @good.name.downcase == 'starwire'
        @good.price = 3360
      end

      @cart.items << OrderGood.from_good(@good)
    end

    respond_to do |format|
      if @cart.save
        cookies['_token'] = @cart.token
        format.html { redirect_to cart_url, notice: '_cart_good_added' }
      else
        abort @cart.errors.to_json
        format.html { render action: 'show' }
        format.json { render json: @cart.errors, status: :unprocessable_entity }
      end
    end
  end

  def finish
    respond_to do |format|
      if @cart.update(order_params)
        format.html { redirect_to cart_ordered_url, notice: '_order_added' }
      end
    end
  end

  def update
    #abort update_cart_params.inspect
    to_delete = @cart.items

    update_cart_params.each do |item|
      cart_item = OrderGood.find item[:order_good]
      if item[:variant].present?
        cart_item.variant = Variant.find item[:variant]
        cart_item.price = cart_item.variant.price
      end
      cart_item.quantity = item[:quantity]
      cart_item.save

      to_delete = to_delete.select { |d| d.good_id != cart_item.good_id }
    end

    to_delete.each(&:delete) if to_delete.present?

    respond_to do |format|
      format.html { redirect_to order_show_url, notice: '_cart_goods_updated' }
      format.json { head :no_content }
    end
  end

  def remove_good
    respond_to do |format|
      if OrderGood.delete cart_good_params[:id]
        format.html { redirect_to cart_url, notice: '_cart_good_removed' }
      end
    end
  end

  private
  def check
    raise PageNotFound unless @language.is_default
  end

  def set_good
    @good = Good.find good_params[:id]
  end

  def good_params
    params.require(:good).permit([:id])
  end

  def cart_good_params
    params.require(:order_good).permit([:id])
  end

  def delivery_params
    params.require(:cart).permit([:country, :region, :city, :street, :street_number, :site, :comment, :zip, :delivery_type, :payment_type, :client => [:first_name, :last_name, :email, :phone]])
  end

  def update_cart_params
    if params[:cart]
      params.require(:cart)[:items].map do |item|
        cart_item = {
            order_good: item[0].to_i,
            quantity: item[1]['quantity'].to_i
        }

        cart_item[:variant] = item[1]['variant'].to_i if item[1]['variant'].present?
        cart_item
      end
    else
      []
    end
  end
end
