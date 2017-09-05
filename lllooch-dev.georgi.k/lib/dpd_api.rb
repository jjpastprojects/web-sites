# Класс для работы с API PDP

require 'uri'
require 'net/http'
require 'json'
require 'savon'

class DpdApi

  def initialize
    @client = Savon.client(wsdl: "http://ws.dpd.ru/services/calculator2?wsdl")
    @errors = nil

    @url = URI('http://dpd.ru/ols/calcint/cityru.jsp')
  end

  def raw
    @errors
  end

  def get_cities
    params = {}
    params['request'] = 'xmlForm'

    res = Net::HTTP.start(@url.host, @url.port) do |http|
      req = Net::HTTP::Post.new(@url.path)
      req.set_form_data(params)
      response = http.request(req)
    end

    result = JSON.parse(res.body)
    cities = 0
    if result['geonames'].present?
      result['geonames'].each do |geo|
        dpd_city = DpdCity.find_or_initialize_by city: geo['name'], region: geo['reg']
        dpd_city.update city_id: geo['id']
        cities += 1
      end
    end

    cities
  end

  # считаем доставку
  def get_price(request_params)

    dpd_city = DpdCity.find_by city: request_params['city'], region: request_params['region']

    if dpd_city.present?
      delivery_params = {
        cityId: dpd_city.city_id
      }
    else
      delivery_params = {
        cityName: request_params['city']
        #regionName: request_params['region']
      }
    end

    begin
      response = @client.call(:get_service_cost) do
        message request: request = {
            auth: {
                # номер клиента
                clientNumber: '1001030673',

                # API-ключ
                clientKey: 'CCA7DE85C0B00F859D50F7CDE5A129C278D499DD'
            },
            pickup: {
                cityName: 'Москва'
            },

            delivery: delivery_params,

            selfPickup: false,
            selfDelivery: false,

            weight: request_params['weight'],
            volume: request_params['volume'],

            #DPD Consumer
            serviceCode: 'CSM'
        }
      end

      return response.body[:get_service_cost_response][:return][:cost]
    rescue Savon::SOAPFault => e
      Rails.logger.error "\n\nDPD_ERROR:  " + e.inspect + "\n"
      Rails.logger.error "REQUESTED:  " + request_params.inspect + "\n\n"
      return nil
    end
  end
end