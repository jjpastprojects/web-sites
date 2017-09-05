json.array!(@designers) do |designer|
  json.extract! designer, 
  json.url designer_url(designer, format: :json)
end
