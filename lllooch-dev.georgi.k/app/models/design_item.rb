# заглушка товара дизайнера
# типа .. coming soon + фотка и название
class DesignItem < ActiveRecord::Base
  include MultilingualModel

  belongs_to :designer

  translates :name

  attr_accessor :icon
  attr_accessor :picture

  has_attached_file :icon,
                    styles: {preview: "300x300#", admin: "50x50#"},
                    default_url: "/images/:style/missing.png",
                    url: "/uploads/design_items/:id/icon/:style/:basename.:extension",
                    path: ":rails_root/public/uploads/design_items/:id/icon/:style/:basename.:extension"

  has_attached_file :picture,
                    styles: {preview: "300x300#", admin: "50x50#"},
                    default_url: "/images/:style/missing.png",
                    url: "/uploads/design_items/:id/picture/:style/:basename.:extension",
                    path: ":rails_root/public/uploads/design_items/:id/picture/:style/:basename.:extension"

  validates :icon, :attachment_presence => true
  validates :picture, :attachment_presence => true
  validates_attachment_content_type :icon, :content_type => ['image/jpeg', 'image/png','image/gif']
  validates_attachment_content_type :picture, :content_type => ['image/jpeg', 'image/png','image/gif']

end
