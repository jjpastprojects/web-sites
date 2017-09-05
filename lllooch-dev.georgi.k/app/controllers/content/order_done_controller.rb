require 'base64'
require 'openssl'
require 'securerandom'

# Контроллер страницы подтверждения покупки
class Content::OrderDoneController < Content::BaseController
  layout 'content'

  before_action :set_order

  def show
    unless cookies['_ga_sent'].present?
      @ga = true
      cookies['_ga_sent'] = true
    end

    @config = {
      URL: 'https://109.73.41.78:5443/cgi-bin/cgi_link',
      BACKREF: admin_acquiring_result_url,
      EMAIL: @order.email,

      TRTYPE: 1,
      TERMINAL: 'CIS0ET14',
      MERCHANT: 'EPB3000E30001PB',
      MERCH: 'lllooch',

      MERCH_URL: 'http://www.lllooch.ru',
      TIMESTAMP: Time.now.strftime('%Y%m%d%H%M%S'),

      NONCE: '595ccd142a89a557',
      CURRENCY: '643',
      ORDER: '0' + @order.id.to_s,
      AMOUNT: @order.full_price,
    }

    @config[:P_SIGN] = create_mac
  end


  private
  def set_order
    token = cookies['_order_done']
    @order = Order.find_by_token token
  end

  def create_mac
    @cypher = %w(NONCE AMOUNT ORDER TIMESTAMP TRTYPE TERMINAL).map{|k| str = @config[k.to_sym]; [str.to_s.mb_chars.length, str].join}.join

    key = '0732D0F58CFDDFCA492DE86A872D033E'
    key = key.scan(/../).map(&:hex).map(&:chr).join
    OpenSSL::HMAC.hexdigest('sha1', key, @cypher)
  end
end

