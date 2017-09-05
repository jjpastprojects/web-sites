# контроллер каталога товаров контентной части сайта
# возвращает:
# - список постов
# - пост
# - json-массив с постами для текущей категории в backbone

class Content::CatalogsController < Content::BaseController
  before_action :get_locale
  before_action :set_category
  before_action :navigation, only: [:list, :item]
  protect_from_forgery except: [:fetch]

  def list
    @items = Good.all.where('on_main is true')
  end

  def item
    @items = @category.goods
    #render 'list'
  end

  def fetch
    if fetch_params == 'all'
      @goods = Good.all
    elsif fetch_params == 'main'
      @goods = Good.all.where('on_main is true')
    else
      category = Category.find_by_slug fetch_params
      @goods = category.goods.sort_by{|g| g.category_good_weight } if category.present?
    end

    respond_to do |format|
      if @goods
        format.json { render action: 'fetch' }
      else
        format.json { head :no_content }
      end
    end
  end

  def get_item
    @category
  end

  def page_title_prefix
    if @category
      'Каталог:'
    end
  end

  private
    def all_items
      params[:slug] && params[:slug] == 'all'
    end

  def set_category
    @category = GoodCategory.find_by slug: params[:slug]
  end

    def fetch_params
      params.require(:collection)
    end

    def navigation
      links = []

      links << { href: catalog_path, title: T('Все товары'), category: 'all' }

      GoodCategory.all.each do |i|
        links << { href: catalog_item_path(i.slug), title: i.title, category: i.slug }
      end

      @navigation = {
        helper: T("Категории"),
        title: T("Выберите категорию товара"),
        overflowed: true,
        items: links
      }
    end  
end
