json.array!(@properties) do |property|
  json.extract! property, 
  json.url property_url(property, format: :json)
end
