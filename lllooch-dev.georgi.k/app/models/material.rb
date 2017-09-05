# модель материала
class Material < ActiveRecord::Base
  include SortedByName  
  include MultilingualModel

  default_scope { order(:weight) }

  translates :title, :description

  has_attached_file :picture, 
    styles: {thumb: "80x80#", admin: "30x30#", preview: "300x300#"},
    default_url: "/images/:style/missing.png",
    url: "/uploads/materials/:id/:style/:basename.:extension",
    path: ":rails_root/public/uploads/materials/:id/:style/:basename.:extension"

  validates :picture, :attachment_presence => true
  validates_attachment_content_type :picture, :content_type => ['image/jpeg', 'image/png','image/gif']

end
