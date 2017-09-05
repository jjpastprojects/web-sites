# Тип оплаты
# STI цепляет необходимый функционал для выбранного типа
class PaymentType < ActiveRecord::Base
  include MultilingualModel
  translates :name

  default_scope { order(:weight) }

  scope :active, -> { where(is_active: true) }

  validates :type, presence: true
  validates :name, presence: true

  def options
    {
        name: self.name
    }
  end

  def self.types
    {
        'PaymentType::Cash' => 'Наличный расчет',
        'PaymentType::Noncash' => 'Безналичный расчет',
        'PaymentType::Card' => 'Картой'
    }
  end
end
