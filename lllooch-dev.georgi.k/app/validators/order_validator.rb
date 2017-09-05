# валидатор заказа
class OrderValidator < ActiveModel::Validator

  # проверяем на стороне сервера возможен ли выбранный тип оплаты при данном типе доставки
  def validate(order)
    if order.delivery_type.present? and order.payment_type.present? and order.order_status != OrderStatus::Canceled.first
      order.errors['delivery_type'] << 'Такой тип оплаты неприменим к выбранному типу доставки!' unless order.delivery_type.payment_types.include? order.payment_type
    end
  end
end