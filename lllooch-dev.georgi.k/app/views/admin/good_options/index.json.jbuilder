json.array!(@good_options) do |good_option|
  json.extract! good_option, 
  json.url good_option_url(good_option, format: :json)
end
