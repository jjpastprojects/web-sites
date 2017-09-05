# параметр сайта
class Setting < ActiveRecord::Base
  default_scope { order('key ASC') }
  include MultilingualModel

  translates :value
  validates  :key, presence: true
end
