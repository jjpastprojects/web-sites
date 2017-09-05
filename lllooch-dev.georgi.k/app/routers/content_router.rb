# Роутер контентной части сайта
class ContentRouter < Object
  # перегрузка роутов
  def self.reload
    @@routes=nil
  end

  # локали для scope в роутере
  def self.locales
    @locales = [I18n.default_locale]

    if ActiveRecord::Base.connection.table_exists? 'languages'
      @locales = []
      Language.all.each{|l| @locales << l.slug}
    end

    Regexp.new @locales.join("|")
  end

  # генерация роутов на основе имеющихся страниц
  def self.routes
    if @@routes.nil?
      if ActiveRecord::Base.connection.table_exists? 'pages'
        @@routes = []
        last = []

        Page.all.each do |page|
          page.routes.each do |r|
            options = {
              page.routed_url(r) => 'content/' + r[:controller].to_s + '#' + r[:action].to_s
            }
            
            options[:as] = r[:as].underscore if r[:as]
            options[:applies_to] = r[:applies_to] if r[:applies_to]
            options[:active] = r[:active] if r[:active]
            options[:page] = page

            if page.url == ''
              last << options
            else
              @@routes << options
            end
          end
        end

        @@routes += last
      end
    end
  
    @@routes
  end

  private 
    @@routes=nil

end