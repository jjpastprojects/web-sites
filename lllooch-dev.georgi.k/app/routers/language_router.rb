# роутер для выбора языка
class LanguageRouter < Object
  def self.reload
    @@routes=nil
  end
  
  def self.routes
    if @@routes.nil?
      if ActiveRecord::Base.connection.table_exists? 'languages'
        @@routes = []

        options = {
          'locale/:slug' => 'content/language#select',
          as: 'locale_set'
        }
        @@routes << options
      end
    end

    @@routes
  end

  private 
    @@routes=nil

end