require 'base64'
require 'openssl'
require 'securerandom'

class AcquireApi
  def initialize(params)
    default_params = {
      TERMINAL: 'CIS0ET14',
      MERCHANT: 'EPB3000E30001PB',
      MERCH: 'lllooch',
      MERCH_URL: 'http://www.lllooch.ru',
      TIMESTAMP: Time.now.strftime('%Y%m%d%H%M%S'),
      NONCE: '595ccd142a89a557',
      TRTYPE: '1',
      CURRENCY: '643'
    }

    #SecureRandom.hex

    @params = default_params.merge! params
    @params[:ORDER] = '021118'
    @params[:AMOUNT] = '21.10'
    @params[:P_SIGN] = create_mac
    #@params[:RRN] = '413400853734'
    #@params[:INT_REF] = 'D11582DD2A765EE4'
  end

  def create_mac
    #@cypher = %w(NONCE).map{|k| str = @params[k.to_sym]; [str.to_s.mb_chars.length, str].join}.join
    @cypher = %w(NONCE AMOUNT ORDER TIMESTAMP TRTYPE TERMINAL).map{|k| str = @params[k.to_sym]; [str.to_s.mb_chars.length, str].join}.join
    #@cypher = Base64.strict_encode64(@cypher)

    key = '0732D0F58CFDDFCA492DE86A872D033E'
    key = key.scan(/../).map(&:hex).map(&:chr).join
    OpenSSL::HMAC.hexdigest('sha1', key, @cypher)
  end

  def url
    'https://109.73.41.78:5443/cgi-bin/cgi_link'
  end

  def params
    @params
  end
end