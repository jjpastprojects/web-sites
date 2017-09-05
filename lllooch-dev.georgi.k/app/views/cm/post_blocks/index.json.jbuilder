json.array!(@post_blocks) do |post_block|
  json.extract! post_block, 
  json.url post_block_url(post_block, format: :json)
end
