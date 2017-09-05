# Контроллер страницы материалов
class Content::MaterialsController < Content::BaseController
  def list
    @materials = Material.all
  end
end
