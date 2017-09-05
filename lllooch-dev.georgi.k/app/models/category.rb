class Category < ActiveRecord::Base  
  include MultilingualModel
  include SluggableModel
  include AutotitleableModel
  
  default_scope { order('weight, name') }

  translates :title, :heading, :keywords, :description

  validates :type, presence: true
  validates :name, presence: true

  belongs_to :parent  
end
