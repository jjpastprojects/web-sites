class VariantProperty < ActiveRecord::Base
  belongs_to :variant
  belongs_to :property
end
