# контроллер дизайнеров
class Content::DesignersController < Content::BaseController
  before_action :get_locale
  
  def list
    @designers = Designer.all
  end

  def item
    @designer = Designer.find(params[:slug])
    raise PageNotFound unless @designer.present?
  end

  def get_item
    @designer
  end
end
