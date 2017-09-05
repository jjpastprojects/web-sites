# Контроллер предзаказа
class Content::PreorderController < Content::BaseController
  layout 'content'

  before_action :check
  before_action :set_preorder, only: [:done]

  def show
    @cart = Order::Preorder.new
    @good = Good.find(item_params['id'])
  end

  def done
    @items = @preorder.items
  end

  def finish
    @cart = Order::Preorder.new
    @cart.order_status = OrderStatus::New.first
    @cart.language = @language
    @cart.token = Order.token

    params = preorder_params
    params[:client] = Client.from_params params[:client]
    params[:type] = 'Order::Preorder'

    respond_to do |format|
      if @cart.update(params)
        @cart.items << OrderGood.from_good(Good.find(preorder_good_params['id']))

        PreorderMailer.order(@cart).deliver
        PreorderMailer.notice(@cart).deliver

        cookies['_preorder_done'] = @cart.token
        format.html { redirect_to preorder_done_url, notice: '_order_updated_successfully' }
      else
        format.html { render action: 'show' }
      end
    end
  end

  private
  def check
    raise PageNotFound unless @language.is_default
  end


  def set_preorder
    @token = cookies['_preorder_done']
    @preorder = Order::Preorder.find_by_token @token
    raise PageNotFound unless @preorder.present?
  end

  def item_params
    params.require(:good).permit(:id)
  end

  def preorder_params
    params.require(:cart).permit([:client => [:first_name, :last_name, :email, :phone]])
  end

  def preorder_good_params
    params.require(:good).permit(:id)
  end
end

