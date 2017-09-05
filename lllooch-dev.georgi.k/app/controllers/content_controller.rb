class ContentController < Content::BaseController
	layout 'content'

	class UnknownLocaleException < StandardError; end

  rescue_from UnknownLocaleException, :with => :not_found
  rescue_from PageNotFound, :with => :not_found

  def not_found(exception)
    render_error 404, exception
  end

  def index
    render 'content/index'
  end

  def show
  end

  def route
    I18n.locale = params[:locale]
    render :controller => :content, :action => :index
  end
end
