# контентный хелпер
module Content::ContentHelper
  def language_alternate
    render 'content/parts/language_alternate', languages: Language.active
  end

  def meta
    controller.meta
  end

  def switch_locale locale
    params["locale"] = locale
    url_for params
  end

  def menu key
    Menu.find_by_key key
  end

  # находит свойство по ключу
  def S key
    setting = Setting.find_by_key key

    if setting
      setting.value
    else
      nil
    end
  end

  # телефоны массивом
  def phones
    phones = Setting.find_by_key('phones')

    if phones
      Globalize.with_locale @language.slug do
        phones.value.split("\n") if phones.value
      end
    else
      []
    end
  end

  # активные языки
  def languages
    Language.active
  end
end
