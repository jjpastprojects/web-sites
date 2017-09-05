json.array!(@goods) do |good|
  json.extract! good, 
  json.url good_url(good, format: :json)
end
