# Базовый контроллер контентной части сайта
# в нем происходит куча всякой всячины:
# - отлавливание ошибок
# - определение текущей страницы
# - инициализация корзины (если таковая имеется)

class Content::BaseController < ApplicationController
  layout 'content'

  helper Content::ContentHelper
  helper Content::CartHelper
  include TranslateHelper

  before_action :get_locale
  before_action :get_path
  before_action :set_token
  before_action :set_cart

  class UnknownLocaleException < StandardError; end
  class PageNotFound < StandardError; end

  rescue_from UnknownLocaleException, :with => :show404
  rescue_from PageNotFound, :with => :show404

  def show404()
    render 'errors/error_404', layout: 'content'
  end

  def index
    render 'content/index', layout: "map"
  end

  def show
  end

  def item
  end

  def list
  end

  def meta
    get_meta
  end

  protected
    def set_token
      @token = cookies['_token'].present? ? cookies['_token'] : Order::Cart.token
    end

    def set_cart
      @cart = Order::Cart.find_by_token_and_order_status_id @token, nil

      unless @cart
        @token = Order::Cart.token
        @cart = Order::Cart.create({token: @token, language: @language})
      end

      @cart.language = @language

      cookies['_token'] = @token
    end

    def get_item
      @current_page
    end

    def page_title_suffix
      ''
    end

    def page_title_prefix
      ''
    end

    def get_meta
      item = get_item

      if item.nil? 
        item = @current_page
      end

      if item
        title = []

        # контроллер наследуется,
        # а в дочерних можно переопределить методы
        # page_title_prefix и page_title_suffix
        title << page_title_prefix.to_s if page_title_prefix
        title << item.title.to_s if item.title
        title << page_title_suffix.to_s if page_title_suffix

        {
          title: title.join(" "),
          heading: item.heading,
          keywords: item.keywords,
          description: item.description
        }
      else
        {}
      end
    end

    def get_path
      @current_page = nil
      Rails.application.routes.router.recognize(request) do |route, matches, param|
        #@asd = ContentRouter.routes
        #abort @asd.inspect
        page = ContentRouter.routes.each do |r|
          if r[:as] == route.name or (r[:applies_to] and r[:applies_to].include?(route.name))
            @current_page = r[:page]
            @current_menu_item = r[:active]
            break 
          end
        end
      end
    end

    def get_locale
      @language = Language.find_by_slug params[:locale]

      unless @language
        @language = Language.find_by_is_default(true)
      end

      I18n.locale = @language.slug || I18n.default_locale
    end

    def default_url_options
      { locale: I18n.locale }
    end

    def render_error(status, exception)
      respond_to do |format|
        format.html { render template: "errors/error_#{status}", layout: 'errors', status: status }
        format.all { render nothing: true, status: status }
      end
    end

end