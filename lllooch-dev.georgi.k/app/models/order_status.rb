# Статусы заказа

class OrderStatus < ActiveRecord::Base
  include MultilingualModel
  translates :name

  default_scope { order(:priority) }

  validates :type, presence: true, uniqueness: true
  validates :name, presence: true

  def self.types
    {
        'OrderStatus::New' => 'Новый',
        'OrderStatus::Done' => 'Выполнен',
        'OrderStatus::Canceled' => 'Отменен'
    }
  end
end
