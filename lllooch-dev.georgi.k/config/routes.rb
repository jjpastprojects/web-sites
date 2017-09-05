CMS::Application.routes.draw do

  #get 'dpd' => 'dpd#show'
  #get 'dellin' => 'dellin#show'

  # роуты для wysiwyg-редактора
  mount RedactorRails::Engine => '/redactor_rails'

  match 'payed', to: 'admin/acquiring#result', via: [:get, :post]

  scope "(:locale)", locale: ContentRouter.locales do
    # поиск?
    # TODO проверить
    get "search/search"

    # backbone-каталог товаров
    post "catalog/fetch" => "content/catalogs#fetch", as: :catalog_fetch

    # backbone-каталог постов
    post "blogs/fetch" => "content/blogs#fetch", as: :blog_fetch
  end

  scope "(:locale)", locale: ContentRouter.locales do
    # поиск
    get "search" => 'search#search', as: :search
  end

  scope '(:locale)/preorder', controller: 'content/preorder', locale: ContentRouter.locales do
    post '', action: :show, as: :preorder_form
    patch '', action: :finish, as: :preorder_finish
  end

  # корзина
  scope '(:locale)/cart', locale: ContentRouter.locales do
    # покупка товара
    post 'buy' => 'content/carts#buy', as: :cart_buy
    get 'buy' => 'content/carts#buy', as: :cart_get_buy

    # сохранение данных о товарах
    post 'update' => 'content/carts#update', as: :cart_update

    # расчет доставки
    patch 'delivery' => 'content/carts#delivery', as: :cart_delivery

    # удаление товара из корзины
    delete controller: 'content/carts', action: :remove_good, as: :cart_remove

    # предзаказ подтверждение
    #scope :preorder, controller: 'content/preorder' do
    #  patch '', action: :finish, as: :preorder_finish
    #end

    # заказ подтверждение
    scope :order, controller: 'content/order' do
      patch '', action: :finish, as: :order_finish
    end
  end

  # рут для админа
  get '/admin' => 'admin/welcome#index'

  # рут для контент-менеджера
  get '/cm' => 'cm/welcome#index', as: :cm_root


  # контент-менеджер
  namespace :cm do
    # категории постов
    resources :post_categories, path: 'blogs' do
      # посты
      get 'items', on: :member, action: :index, as: :items

      # выбор локали для правки
      get ':locale', on: :member, action: :edit, as: 'languaged'

      # сортировка
      post 'order', on: :collection, as: 'order'
    end

    # посты
    resources :posts do
      # блоки
      resources :blocks, controller: 'post_blocks' do
        get ':locale', on: :member, action: :edit, as: :languaged
        post 'order', on: :collection, as: 'order'
      end

      post 'order', on: :collection, as: 'order'
      get ':locale', on: :member, action: :edit, as: :languaged
    end
  end

  # админ
  namespace :admin do
    # рут
    get '' => 'welcome#index', as: 'root'

    # дебаг шаблонов письем
    match 'mailer(/:action(/:id(.:format)))' => 'mailer#:action', via: :get

    scope :acquiring, controller: :acquiring, as: :acquiring do
      get '', action: :index
      get '/cart', action: :card, as: :card
      get '/mac', action: :mac, as: :mac
      post '', action: :result, as: :result
    end

    # меню
    resources :menus

    # заказы, предзаказы
    resources :orders, :preorders, except: [:create, :edit, :update]

    # статусы заказов
    resources :order_statuses do
      get ':locale', on: :member, action: :edit, as: 'languaged'
    end

    # типы доставки
    resources :delivery_types, :payment_types do
      post 'order', on: :collection, as: 'order'
      get ':locale', on: :member, action: :edit, as: 'languaged'
    end

    # категории товаров
    resources :good_categories, path: 'catalog' do
      get 'items', on: :member, action: :index, as: :items
      post 'order', on: :member, action: :order, as: :order
      get ':locale', on: :member, action: :edit, as: 'languaged'
    end

    # группы свойств
    resources :property_types do
      get 'items', on: :member, action: :index, as: :items
      get ':locale', on: :member, action: :edit, as: 'languaged'
    end

    # меню
    resources :menus do
      # элементы меню
      resources :menu_items
    end

    # свойства, языки, страницы, теги, параметры, переводы
    resources :properties, :languages, :pages, :tags, :settings, :translations do
      get ':locale', on: :member, action: :edit, as: 'languaged'
    end

    # элементы меню, 3д-вьюхи, файлы, варианты, материалы
    resources :menu_items, :three60s, :files, :variants, :materials do
      get ':locale', on: :member, action: :edit, as: 'languaged'
      post 'order', on: :collection, as: 'order'
    end

    # дизайнеры
    resources :designers do
      # товары
      resources :design_items do
        get ':locale', on: :member, action: :edit, as: 'languaged'
      end

      get ':locale', on: :member, action: :edit, as: 'languaged'
      post 'order', on: :collection, as: 'order'
    end


    # товары
    resources :goods do
      # файлы
      resources :files, only: [:new, :create]

      # 3д-вьюхи
      resources :three60s, only: [:new, :create]

      # варианты
      resources :variants, only: [:new, :create]

      post 'order', on: :collection, as: 'order'
      get ':locale', on: :member, action: :edit, as: 'languaged'
    end

  end

  # подключение языкового роутера
  LanguageRouter.reload
  unless LanguageRouter.routes.nil?
    LanguageRouter.routes.each do |r|
      get r
    end
  end


  # подключение контентного роутера
  ContentRouter.reload
  unless ContentRouter.routes.nil?
    scope "(:locale)", locale: ContentRouter.locales do
      ContentRouter.routes.each do |r|
        get r.except(:page, :applies_to, :active)
      end
    end
  end

  # редиректы товаров
  #GoodsRouter.reload
  unless GoodsRouter.routes.nil?
    GoodsRouter.routes.each do |r|
      get r[:route] => redirect(r[:redirect_to])
    end
  end


  match '*a', :to => 'content#show404', via: [:get, :post]
end
