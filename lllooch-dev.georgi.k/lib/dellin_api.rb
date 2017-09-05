# Класс для работы с API деловых линий

require 'uri'
require 'net/http'

class DellinApi

  def initialize
    @url = URI('http://public.services.dellin.ru/calculatorService2/index.html?=')
    @result = []
  end


  # кешируем коды городов
  def get_kladrs
    params = {}
    params['request'] = 'xmlForm'

    res = Net::HTTP.start(@url.host, @url.port) do |http|
      req = Net::HTTP::Post.new(@url.path)
      req.set_form_data(params)
      response = http.request(req)
    end

    result = Hash.from_xml(res.body)
    cities = 0
    if result['data'].present? and result['data']['cities'].present? and result['data']['cities']['city'].present?
      result['data']['cities']['city'].each do |city|
        Kladr.find_or_create_by city: city['name'], code: city['codeKLADR']
        cities += 1
      end
    end

    cities
  end

  def raw
    @result
  end

  # код города
  def get_code(city)
    code = Kladr.find_by(city: city)
    code.code if code.present?
  end

  # считаем доставку
  def get_price(request_params)

    params = {}
    params['request'] = 'xmlResult'
    params['derivalPoint'] = get_code('Москва')
    params['arrivalPoint'] = get_code(request_params['city'])

    params['sizedWeight'] = request_params['weight']
    params['sizedVolume'] = request_params['volume']

    res = Net::HTTP.start(@url.host, @url.port) do |http|
      req = Net::HTTP::Post.new(@url.path)
      req.set_form_data(params)
      response = http.request(req)
    end

    result = Hash.from_xml(res.body)
    @result << result

    if result['data'].present? and result['data']['price'].present?
      result['data']
    end
  end
end