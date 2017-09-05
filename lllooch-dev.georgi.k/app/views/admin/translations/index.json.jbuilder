json.array!(@translations) do |translation|
  json.extract! translation, 
  json.url translation_url(translation, format: :json)
end
