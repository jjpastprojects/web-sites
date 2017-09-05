# вьюха 360

require 'rubygems'
# zip-библиотечка пригодится, ага
require 'zip'

class Three60 < MediaFile
  before_destroy :cleanup
  attr_accessor :src

  default_scope { order('weight ASC') }
  default_scope { where('is_uploaded is not null') }


  def items
    items = media_files.order('src_file_name ASC')
    if is_reverted
      items.reverse!
    end
    items
  end

  has_attached_file :src, 
    styles: {preview: "800x800>", thumb: "120x80>"},
    default_url: "/images/:style/missing.png",
    url: "/uploads/three60/:id/:style/:basename.:extension",
    path: ":rails_root/public/uploads/three60/:id/:style/:basename.:extension",
    convert_options: { preview: "-quality 80" }

# validates :src, :attachment_presence => true
# validates_attachment_content_type :src, :content_type => ['image/jpeg', 'image/png','image/gif']

  # распаковываем архив и лопатим картинки
  def unpack path
    unless path.empty?
      Zip::File::open(path) do |archive|
        archive.each_with_index do |entry, index|
          
          if entry.file?
            image = File.join('tmp/zip/goods/', good.id.to_s, entry.name)

            FileUtils.mkdir_p File.dirname(image)
            archive.extract entry, image unless File.exist?(image)

            file = File.open image

            if index == 0
              Three60.preview self, file
            end

            Three60.item self, file
            file.close

            File.delete image if File.exist?(image)
          end
        end
      end

      File.delete path if File.exist?(path)
    end

    update({
      is_uploaded: true
    })
  end

  # сохраняем превьюху
  def self.preview model, file
    model.src = file
  end

  # создаем элемент вьюхи, вложенный в текущий
  def self.item parent, file
    item = Three60.new(
      good: parent.good,
      src: file,
      is_uploaded: true
    )

    item.media_file = parent
    item.save
  end

  # чистим мусор при удалении
  def cleanup
    if src.file?
      FileUtils.rm_rf (File.dirname(src.path) + '/../')
    end
  end
end