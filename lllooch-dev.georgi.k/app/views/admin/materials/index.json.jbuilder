json.array!(@materials) do |material|
  json.extract! material, 
  json.url material_url(material, format: :json)
end
