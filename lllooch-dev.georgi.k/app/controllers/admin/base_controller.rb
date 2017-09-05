class Admin::BaseController < ApplicationController
  layout 'admin'
  helper Admin::AdminHelper

  before_action :forever_ru

  private
    def permit_params
      params.require(controller_name.singularize).permit get_safe_params
    end

    def forever_ru
      I18n.locale = :ru
    end
end