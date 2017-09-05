# чистим файлы 3д-вьюх, которые не загрузились
namespace :lllooch do
  desc "Cleanup files and other stuff"
  task cleanup: :environment do
    
    Three60.where('is_uploaded <> true and media_file_id is null').each do |i|
      puts "Removing data for good: " + i.good.name + " "
      i.destroy
      puts "✓"
    end
  end
end
