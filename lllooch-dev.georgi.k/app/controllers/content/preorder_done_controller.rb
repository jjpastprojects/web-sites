# Контроллер страницы подтверждения покупки
class Content::PreorderDoneController < Content::BaseController
  layout 'content'

  before_action :set_preorder

  def show
  end

  private
  def set_preorder
    token = cookies['_preorder_done']
    @order = Order.find_by_token token
  end
end

