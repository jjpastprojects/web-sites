class CategoryGood < ActiveRecord::Base
  belongs_to :good_category
  belongs_to :good
end
