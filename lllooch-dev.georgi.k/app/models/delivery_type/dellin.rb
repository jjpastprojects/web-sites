require 'dellin_api'

class DeliveryType::Dellin < DeliveryType
  def is_cost_calc_needed?
    true
  end

  def calculate(order, params = nil)
    params = params.present? ? params.select{|k, v| Order.delivery_params.include?(k.to_sym)} : order.delivery_params

    params['weight'] = order.items_weight(true)
    params['volume'] = order.items_volume(true)

    dellin = DellinApi.new
    request = dellin.get_price(params)
    price = (request.present? and request['price'].present?) ? request['price'] : nil

    if price.present?
      create_request(order, params, price)
      { price: price, message: '' }
    else
      order.delivery_request.delete if order.delivery_request.present?
      self.errors[:calculate] << 'Доставка по этому адресу компанией Деловые линии не осуществляется. С Вами свяжется наш менеджер для выбора другой транспортной компании.'
    end
  end
end