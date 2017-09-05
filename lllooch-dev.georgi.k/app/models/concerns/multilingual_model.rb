# модуль прописывает возможность
# изменять данные для разных локалей модели
module MultilingualModel
  extend ActiveSupport::Concern

  included do 
    attr_accessor :locale

    def locale_exists slug
      !self.class.with_translations(slug).empty?
    end
  end
end