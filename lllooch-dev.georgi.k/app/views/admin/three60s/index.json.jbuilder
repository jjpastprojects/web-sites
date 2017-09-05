json.array!(@three60s) do |three60|
  json.extract! three60, 
  json.url three60_url(three60, format: :json)
end
