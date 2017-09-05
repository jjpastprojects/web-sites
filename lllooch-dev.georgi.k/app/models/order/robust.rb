# модель заказа
class Order::Robust < Order
  include OrderConcern

  validates :country, :city, :street, :street_number, :zip, :payment_type, :delivery_type, presence: true, unless: -> { self.skip_validations? }
  before_update :validate_delivery

  before_validation :set_country

  def acquiring
    params = {
        AMOUNT: total_price.to_f,
        BACKREF: id,
        DESC: '',
        ORDER: id,
        EMAIL: email,
        #RRN: '',
        #INT_REF: ''
    }

    AcquireApi.new(params)
  end

  private
  def set_country
    write_attribute(:country, :RU)
  end

  def validate_delivery
    #TODO wat?
  end
end