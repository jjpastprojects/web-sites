# видимо старый контроллер какой-то
# TODO разобраться
class Content::LanguageController < ApplicationController
  def select
    cookies['_locale'] = params[:slug]

    # проверяет, не пришел ли человек сюда обратно с /language
    # и перенаправляет в корень сайта, т.к. язык уже выбран, нечего тут делать
    if request.referer
      url = request.referer
      if URI(request.referer).path == '/language'
        url = '/'
      end
    else
      url = '/'
    end
    redirect_to url
  end
end