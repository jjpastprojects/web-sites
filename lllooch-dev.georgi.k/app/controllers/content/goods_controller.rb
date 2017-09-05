# контроллер товаров
# переопределяется layout для шаблонов
class Content::GoodsController < Content::BaseController
  before_action :get_locale
  layout 'good'

  def item
    @good = Good.find_by_slug params[:slug]
    raise PageNotFound unless @good.present?
  end

  def get_item
    @good
  end
end
