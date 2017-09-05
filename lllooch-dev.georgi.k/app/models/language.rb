# модель языка
# при установке флага "по-умолчанию", снимает этот флаг со всех остальных языков
class Language < ActiveRecord::Base
  include SortedByName
  include MultilingualModel
  include SluggableModel
  include AutotitleableModel

  default_scope { order('is_default DESC') }
  scope :active, -> { where(is_active: true) }

  translates :title
  validates :name, presence: true

  after_save :check_defaultness

  def check_defaultness
    if is_default == true
      Language.where('id <> ?', id).each do |l|
        l.update_columns({is_default: false})
      end
    end
  end
end
