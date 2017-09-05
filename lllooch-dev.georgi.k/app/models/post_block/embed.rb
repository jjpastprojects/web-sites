class PostBlock::Embed < PostBlock
  validates :content, presence: true, on: :update
end
