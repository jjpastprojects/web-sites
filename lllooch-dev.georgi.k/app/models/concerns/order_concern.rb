# модуль определяет выборку заказов по-умолчанию:
# все, кроме статуса == Отменен
module OrderConcern
  extend ActiveSupport::Concern

  included do
    # показываем все, кроме статусов "отменен"
    default_scope { where.not(order_status_id: OrderStatus::Canceled.first) }
  end

  #def alert_after_save
  #  abort 'after save'
  #  #abort self.type_change if self.type_change.present?
  #  #self.order_status = OrderStatus::New.first
  #end
end