class HomeController < ApplicationController
  def index

  #	if current_user.has_role? :admin
  #    redirect_to 
   #   end 
    #    else

    @products = Product.all
  end
end
