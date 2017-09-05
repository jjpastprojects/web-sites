# хелпер переводов
module TranslateHelper
  # ищем перевод по ключу,
  # если такового не имеется — создаем
  def T key, language = false
    translation = Translation.find_by_key key

    if !language
      if !@language
        language = Language.find_by_is_default true
      else 
        language = @language
      end
    end

    if translation
      unless translation.source
        params = {}

        if @current_page[:name]
          params[:source] = @current_page[:name]
        elsif @current_page.name
          params[:source] = @current_page.name
        end

        if defined? request and !request.nil? and request.path
          params[:url] = request.path
        end

        translation.update params
      end

      Globalize.with_locale language.slug do
        value = translation.value || key
      end
    else
      Translation.create(key: key)
      key
    end
  end
end