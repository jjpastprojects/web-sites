# Sidekiq-воркер
# запускает обработку зип-файла
class Three60Worker
  include Sidekiq::Worker
  sidekiq_options :retry => false

  def perform(id, path)
    three60 = Three60.find id
    if three60
      logger.info 'Unpacking to ' + id.to_s + " from #{path}{" + File.exist?(path).to_s + '}'
      three60.unpack path 
    else
      logger.warn 'Three60 is not found: ' + id.to_s
    end
  end
end