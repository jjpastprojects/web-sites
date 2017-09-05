index = 0
json.array!(@goods) do |good|
  json.i "#{index}"
  json.logo image_url(good.logo)
  json.url goods_item_path(good.slug)
  json.picture image_url(good.thumb.url(:preview))
  index += 1
end
