# модель корзины
# представляет собой STI-класс
# на первом этапе мы только проверяем доставку, нужен ли ее расчет/запрос
class Order::Cart < Order
  before_update :check_status_change
  after_update :validate_delivery

  private
  def validate_delivery
    delivery_request = self.delivery_request

    if self.delivery_type.present?
      if !delivery_request.present? or self.delivery_type != delivery_request.delivery_type or (self.delivery_params.select{ |k, v| v != ActiveSupport::JSON.decode(delivery_request.params)[k] }.present?)
        self.delivery_type.calculate(self, nil)
      end
    end
  end


  def check_status_change
  	# если тип сменился на "предзаказ" или "заказ", проставляем статус "новый"
    if type_change.present?
      if ['Order::Robust', 'Order::Preorder'].include? type
        self.order_status = OrderStatus::New.first unless self.order_status.present?
      end
    end
  end
end