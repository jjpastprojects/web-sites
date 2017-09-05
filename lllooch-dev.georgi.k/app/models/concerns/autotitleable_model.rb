# модуль подключается к моделям
# проставляет значение тайтл
module AutotitleableModel
  extend ActiveSupport::Concern

  included do 
    before_create :check_title

    def check_title
      self.title = name if title and title.empty?
    end
  end
end