# модуль прикрепляет аватар к текущей модели
# вместе с валидациями и пр.
module AvatarModel
  extend ActiveSupport::Concern

  included do 
    attr_accessor :avatar

    has_attached_file :avatar, 
      styles: self.avatar_sizes, 
      default_url: "/images/:style/missing.png",
      url: "/uploads/" + self.class.name.underscore + "/:id/:style/:basename.:extension",
      path: ":rails_root/public/uploads/" + self.class.name.underscore + "/:id/:style/:basename.:extension"
  end
end