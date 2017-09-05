# хелпер корзины
module Content::CartHelper

  # количество элементов в корзине
  def cart_items
    if @cart.nil?
      token = cookies['_token']
      cart = Order::Cart.find_by_token_and_order_status_id token, nil
    else
      cart = @cart
    end

    cart.items
  end

  # количество элементов в скобках
  def cart_size
    if cart_items.size > 0
      '(' + content_tag(:span, @cart.items_quantity.to_s, data: {type: 'cart-helper'}).html_safe + ')'
    end
  end
end