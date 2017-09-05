class PostBlock::Html < PostBlock
  validates :content, presence: true, on: :update
end
