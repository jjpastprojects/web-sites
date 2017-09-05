class ApplicationController < ActionController::Base
  # Prevent CSRF attacks by raising an exception.
  # For APIs, you may want to use :null_session instead.
  protect_from_forgery with: :exception

  before_action :configure_permitted_parameters, if: :devise_controller?
  before_action :restrict_to_splash_page, unless: :devise_controller?

  before_action :require_login!

  # suppress SQL logging
  ActiveRecord::Base.logger = Logger.new('/dev/null')

  protected

    def render_json_errors(model)
      render json: {errors: model.errors}, status: :unprocessable_entity
    end

    def configure_permitted_parameters
      devise_parameter_sanitizer.for(:sign_up) << [:first_name, :last_name, :username, :email, :country, :state]
      devise_parameter_sanitizer.for(:sign_in) { |u| u.permit(:username, :password, :remember_me) }
    end

    def restrict_to_splash_page
      #redirect_to splash_path unless user_signed_in?
    end
   

  private
    def require_login!
      return unless !user_signed_in?

      # whitelist some pages that don't need login
      vars = [params[:controller], params[:action], request.method]
      case vars
        when ['splash', 'index', 'GET'] # I think this is unused right now (was splashscreen)
          return
        when ['contests', 'browse', 'GET'] # homepage
          return
        when ['users', 'signin_popup', 'GET'] # user getting login popup
          return
        when ['sessions', 'create', 'POST'] # user logging in
          return
        when ['registrations', 'create', 'POST'] # user logging in
          return
        when ['password_resets', 'new', 'GET'] # user logging in
          return
        when ['password_resets', 'create', 'POST'] # user logging in
          return
        when ['password_resets', 'edit', 'GET'] # user logging in
          return
        when ['password_resets', 'update', 'POST'] # user logging in
          return
      end

      # I'm not 100% happy with this... redirect to homepage if user hits a page requiring login.
      # Ideally we'd cause the "sign-in" overlay to pop up. But there's no
      # URL I can redirect to for the sign-in URL -- it only pops up due to client-side JS.
      redirect_to main_app.root_url
    end
end
