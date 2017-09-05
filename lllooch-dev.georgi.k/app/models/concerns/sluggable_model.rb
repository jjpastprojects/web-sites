# модуль позволяет автоматом прописать
# транслитерированный путь при создании экземпляра модели
module SluggableModel
  extend ActiveSupport::Concern

  included do 
    before_create :generate_slug

    def generate_slug
      self.slug = name.parameterize
    end

    def path
      self.class.name.underscore.pluralize + '/' + slug
    end
  end
end