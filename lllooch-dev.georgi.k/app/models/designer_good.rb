# товар дизайнера
class DesignerGood < ActiveRecord::Base
  belongs_to :designer
  belongs_to :good
end
