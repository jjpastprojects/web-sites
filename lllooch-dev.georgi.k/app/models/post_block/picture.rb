# Блок::Картинка, STI
class PostBlock::Picture < PostBlock
  has_attached_file :picture,
                    styles: {blog: "370x370#", preview: "100x100>"},
                    default_url: "/images/:style/missing.png",
                    url: "/uploads/post_blocks/:id/:style/:basename.:extension",
                    path: ":rails_root/public/uploads/post_blocks/:id/:style/:basename.:extension"

  validates :picture, :attachment_presence => true, on: :update
  validates_attachment_content_type :picture, :content_type => ['image/jpeg', 'image/png','image/gif'], on: :update
end
