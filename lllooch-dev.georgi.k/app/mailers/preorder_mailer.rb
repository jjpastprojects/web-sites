# Мейлер предзаказа
class PreorderMailer < ActionMailer::Base

  include TranslateHelper
  add_template_helper(TranslateHelper)

  # хардкод тут потому, что нельзя использовать другой имейл, отличный от настроек мейлера, т.к. smtp его не пропустит
  default from: "order@lllooch.ru"


  def order order
    @order = order
    @current_page = {name: "Письмо клиенту"}
    mail(to: order.email, subject: T('Предзаказ на сайте www.lllooch.ru', order.language))
  end


  def notice order
    @order = order
    @current_page = {name: "Письмо о новом предзаказе"}
    mail(to: 'order@lllooch.ru', subject: "Поступил предзаказ!")
  end

end
