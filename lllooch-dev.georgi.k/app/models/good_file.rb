# модель файлов товара
# STI:
# - dwg
# - pdf

class GoodFile < ActiveRecord::Base
  include MultilingualModel

  self.table_name = 'files'
  mount_uploader :src, FileUploader

  default_scope { order('weight ASC') }
  translates :name

  before_save :set_size
  belongs_to :good

  validates_presence_of :type
  validates_presence_of :name

  validates_integrity_of :src
  validates_processing_of :src

  def set_size
    self.size = src.file.size.to_s unless src.file.nil?
  end

  def filename
    File.basename(src.path) unless src and src.path.nil?
  end
end