# Контроллер стартовой страницы выбора языка
class Content::LanguageSelectController < Content::BaseController
  layout 'map'
  helper Content::ContentHelper

  before_action :get_locale, except: [:index] 
  
  def index
    render 'content/index'
  end
end