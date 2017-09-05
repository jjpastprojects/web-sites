require 'net/http'
require 'uri'

# Контроллер заказа
class Content::OrderController < Content::BaseController
  layout 'content'

  before_action :check
  before_action :check_cart, only: [:show]
  before_action :set_order, only: [:done]

  def show
    redirect_to cart_path unless @cart.items.present?
  end

  def done
    @items = @order.items
  end

  def redirect
    @gateway_uri = url
    puts "!!!!!"
    puts @config
    puts "?????"
  end

  def finish
    cookies['_ga_sent'] = nil
    params = order_params
    params[:client] = Client.from_params params[:client]

    # STI-тип заказа, см модели
    #@cart = @cart.becomes! Order::Robust
    params[:type] = 'Order::Robust'

    params[:delivery_type] = DeliveryType.find(params[:delivery_type]) if params[:delivery_type].present?
    params[:payment_type] = PaymentType.find(params[:payment_type]) if params[:payment_type].present?


    respond_to do |format|
      if @cart.update(params)
        if @cart.payment_type.is_a? PaymentType::Card

          @config = {
            BACKREF: admin_acquiring_result_url,
            EMAIL: params[:client][:email],

            TRTYPE: 1,
            TERMINAL: 'CIS0ET14',
            MERCHANT: 'EPB3000E30001PB',
            MERCH: 'lllooch',

            MERCH_URL: 'http://www.lllooch.ru',
            TIMESTAMP: Time.now.strftime('%Y%m%d%H%M%S'),

            NONCE: '595ccd142a89a557',
            CURRENCY: '643',
            ORDER: '0' + @cart.id.to_s,
            AMOUNT: @cart.full_price
          }

          @config[:P_SIGN] = create_mac

          format.html { render action: 'redirect' }

          #req = Post.new(URI(url))
          #req.form_data = @config
          #req.basic_auth url.user, url.password if url.user
          #start(url.hostname, url.port,
          #      :use_ssl => url.scheme == 'https' ) {|http|
          #  http.request(req)
          #  format.html { redirect_to @config[:URL] }
          #}

          ##format.html { redirect_to order_payment_url }
          #format.html { redirect_to order_done_url, notice: '_order_updated_successfully' }
        else
          OrderMailer.order(@cart).deliver
          OrderMailer.notice(@cart).deliver

          cookies['_order_done'] = @cart.token
          format.html { redirect_to order_done_url, notice: '_order_updated_successfully' }
        end
      else
        format.html { render action: 'show' }
      end
    end
  end

  private
  def url
    'https://109.73.41.78:5443/cgi-bin/cgi_link'
  end

  def create_mac
    @cypher = %w(NONCE AMOUNT ORDER TIMESTAMP TRTYPE TERMINAL).map{|k| str = @config[k.to_sym]; [str.to_s.mb_chars.length, str].join}.join

    key = '0732D0F58CFDDFCA492DE86A872D033E'
    key = key.scan(/../).map(&:hex).map(&:chr).join
    OpenSSL::HMAC.hexdigest('sha1', key, @cypher)
  end

  def check
    raise PageNotFound unless @language.is_default
  end

  def set_order
    @order = Order::Preorder.find_by_token @token
  end

  def check_cart
    redirect_to cart_path unless @cart.items.present?
  end

  def order_params
    params.require(:cart).permit([:country, :region, :city, :street, :street_number, :site, :comment, :zip, :delivery_type, :payment_type, :client => [:first_name, :last_name, :email, :phone]])
  end
end

