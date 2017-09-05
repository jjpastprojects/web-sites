# базовый класс, который наследуют все контроллеры контентной части
# пустой потому, что нечего тут больше делать, куча всего ушло в модули

class Content::ContentController < Content::BaseController
  before_action :get_locale
end
