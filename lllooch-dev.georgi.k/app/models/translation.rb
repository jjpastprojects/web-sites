# переводы на сайте
class Translation < ActiveRecord::Base
  include MultilingualModel
  translates :value

  default_scope { order('key') }
end
