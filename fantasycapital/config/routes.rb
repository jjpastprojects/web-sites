require "resque_web"

Main::Application.routes.draw do

  
  
  ActiveAdmin.routes(self)
  
  
  ResqueWeb::Engine.eager_load!

  mount ResqueWeb::Engine => "/resque_web"

  get "users/leadboard"
  get "users/signin_popup"

  get "splash/index", as: :splash
  root to: "contests#browse"

  get "terms/", :controller => "terms", :action => "index"
  get "privacy-policy/", :controller => "privacy_policy", :action => "index"

  devise_for :users, :controllers => {:sessions => 'sessions', :registrations => 'registrations' }

  get '/users/subregion_options' => 'users#subregion_options'
  resources :pages do
    collection do
      get :rules_faq
    end
  end
  resources :entries do
    member do
        post 'admin'
    end
  end

  scope(:path => 'admin', :as => 'admin') do
    get 'games', to: 'admin#games'
    get 'entries', to: 'admin#entries'
    get 'contests', to: 'admin#contests'
    get 'users', to: 'admin#users'
    get "/", to: "admin#index"
  end


  resources :lineups do
    member do
      get :export
    end
    resource :entries
  end
  resources :players, only: [] do
    member do
      get :stats
    end
  end
  resources :contests, only: [:index, :show] do
    collection do
      get 'browse'
    end
  end

  resources :waiting_lists, only: [:new, :create, :show] do
    collection do
      get :invite
      post :inviting
    end
  end

  resources :accounts, only: [:create, :edit, :show, :index] do
    collection do
      get :new_cc
      get :profile
      get :history
      get :withdraw
      get :add_fund

      resources :credit_cards
      post 'credit_cards/deposit' => 'credit_cards#deposit'

      get 'bank_accounts/withdrawal' => 'bank_accounts#withdrawal', :as => :withdrawal
      post 'bank_accounts/withdrawal' => 'bank_accounts#withdrawal_post'
      resources :bank_accounts
    end
  end

   resources :projections do
     collection do
       get "with_stats/:sport_name" => 'projections#with_stats'
       get "stats_by_game/:sport_name" => 'projections#stats_by_game', :as => :stats_by_game
       get ":sport_name" => 'projections#index' # funky, index has a parameter? does this work?
     end
     resources :projection_by_stats do
       resources :projection_by_stat_and_games do
         resources :projection_breakdowns
       end
     end
   end

  resources :password_resets

  #scope :api do
    #get "/searchEntries" => "api#searchEntries"
    #get "/gc_data/:entry_id" => "api#gc_data"
    #get "/gc_data2/:entry_id" => "api#gc_data2"
  #end

  # sidekiq web UI
  require 'sidekiq/web'
  mount Sidekiq::Web => '/sidekiq'

  # The priority is based upon order of creation: first created -> highest priority.
  # See how all your routes lay out with "rake routes".

  # You can have the root of your site routed with "root"
  # root 'welcome#index'

  # Example of regular route:
  #   get 'products/:id' => 'catalog#view'

  # Example of named route that can be invoked with purchase_url(id: product.id)
  #   get 'products/:id/purchase' => 'catalog#purchase', as: :purchase

  # Example resource route (maps HTTP verbs to controller actions automatically):
  #   resources :products

  # Example resource route with options:
  #   resources :products do
  #     member do
  #       get 'short'
  #       post 'toggle'
  #     end
  #
  #     collection do
  #       get 'sold'
  #     end
  #   end

  # Example resource route with sub-resources:
  #   resources :products do
  #     resources :comments, :sales
  #     resource :seller
  #   end

  # Example resource route with more complex sub-resources:
  #   resources :products do
  #     resources :comments
  #     resources :sales do
  #       get 'recent', on: :collection
  #     end
  #   end

  # Example resource route with concerns:
  #   concern :toggleable do
  #     post 'toggle'
  #   end
  #   resources :posts, concerns: :toggleable
  #   resources :photos, concerns: :toggleable

  # Example resource route within a namespace:
  #   namespace :admin do
  #     # Directs /admin/products/* to Admin::ProductsController
  #     # (app/controllers/admin/products_controller.rb)
  #     resources :products
  #   end
end
