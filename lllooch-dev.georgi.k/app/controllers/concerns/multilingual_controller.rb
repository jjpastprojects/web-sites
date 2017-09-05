# это специальный модуль, который расширяет функционал контроллера
# он отвечает за мультиязычность
# сначала пытается определить локаль из POST-параметров, если это CREATE/UPDATE
# потом пытается определить локаль из GET, если это EDIT
# если нигде не удалось выхватить локаль, ставится локаль по-умолчанию
# после того, как локаль определена, сервис I18n (мультиязыковая поддержка) настраивается на выбранную локаль

module MultilingualController
  extend ActiveSupport::Concern

  included do
    before_action :set_locale_from_post, only: [:create, :update]
    before_action :set_locale, only: [:edit]
    before_action :set_default_locale
    before_action :set_i18n, only: [:update, :create]

    after_action :revert_locale, only: [:create, :update]

    private
      def get_safe_params
        params = safe_params
        params << :locale
      end

      def set_locale
        @locale = Language.find_by_slug(params[:locale])
      end

      def set_locale_from_post  
        @locale = Language.find_by_slug(item_params[:locale].to_s)
      end

      def set_default_locale
        if !@locale
          @locale = Language.find_by_is_default(true)
        end
      end

      def set_i18n
        I18n.locale = @locale.slug
      end

      def revert_locale
        I18n.locale = 'ru'
      end

      def item_params
        self.send(controller_name.singularize + '_params')
      end
  end
end