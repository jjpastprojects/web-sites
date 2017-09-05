json.array!(@variants) do |variant|
  json.extract! variant, 
  json.url variant_url(variant, format: :json)
end
