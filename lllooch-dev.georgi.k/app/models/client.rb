# Модель клиента
class Client < ActiveRecord::Base
  has_many :orders

  validates :first_name, presence: true
  validates :last_name, presence: true
  validates :email, presence: true, uniqueness: true

  def full_name(inverse = false)
    full_name = []

    full_name << self[:first_name] if self[:first_name].present?
    full_name << self[:last_name] if self[:first_name].present?
    full_name.reverse! if inverse
    full_name.join ' '
  end

  # метод класса, который находит или создает клиента по email
  # и обновляет все остальные аттрибуты из параметров
  def self.from_params params={}
    client = self.find_or_initialize_by email: params[:email]
    client.update(params)
    client
  end
end