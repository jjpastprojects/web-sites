# Тип страницы
# предопределяет роуты, доступные для страницы
class PageType < ActiveRecord::Base

  def routes url
    if method == 'content'
      content_routes url
    elsif method == 'order'
      order_routes url
    elsif method == 'preorder'
      preorder_routes url
    elsif method == 'order_done'
      order_done_routes url
    elsif method == 'preorder_done'
      preorder_done_routes url
    elsif method == 'cart'
      cart_routes url
    elsif method == 'languages_select'
      languages_select_routes url
    elsif method == 'list_with_items'
      list_with_items_routes url
    elsif method == 'list'
      list_routes url
    else
      method == 'item'
      item_routes url
    end
  end

  private
  # заказ
  def order_routes url
    [
        {route: '', action: 'show', controller: 'order', as: 'order_show', applies_to: ['order_finish']},
    ]
  end

  # предзаказ
  def preorder_routes url
    [
        {route: '', action: 'show', controller: 'preorder', as: 'preorder_show', applies_to: ['preorder_form']},
    ]
  end

  # подтверждение заказа
  def order_done_routes url
    [
        {route: '', action: 'show', controller: 'order_done', as: 'order_done'},
    ]
  end

  def preorder_done_routes url
    [
        {route: '', action: 'show', controller: 'preorder_done', as: 'preorder_done'},
    ]
  end

  # страница выбора языка
  def languages_select_routes url
    [{route: '', action: 'index', controller: 'language_select', as: 'language_select'}]
  end

  # корзина
  def cart_routes url
    [{route: '', action: 'index', controller: 'carts', as: 'cart'}]
  end

  # контент
  def content_routes url
    [{route: '', action: 'show', controller: 'content', as: url}]
  end

  # список с элементами
  def list_with_items_routes url
    list_routes(url) + item_routes(url)
  end

  # список
  def list_routes url
    [
        {route: '', action: 'list', as: url}
    ]
  end

  # элементы
  def item_routes url
    [
        {route: ':slug', action: 'item', as: url + '_item', active: (url == 'goods' ? 'catalog' : url) + '_path', dropdown: true}
    ]
  end
end
