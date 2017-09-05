module ClearAttachment
  extend ActiveSupport::Concern

  included do
    validate :check_attachments
  end

  def check_attachments
    abort attributes.inspect
  end
end