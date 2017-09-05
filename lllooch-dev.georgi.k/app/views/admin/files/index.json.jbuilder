json.array!(@pdfs) do |pdf|
  json.extract! pdf, 
  json.url pdf_url(pdf, format: :json)
end
