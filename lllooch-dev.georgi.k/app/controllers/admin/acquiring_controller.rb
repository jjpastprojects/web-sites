require 'base64'
require 'openssl'

class Admin::AcquiringController < Admin::BaseController

  protect_from_forgery except: :result

  before_action :set_config, except: [:index]
  before_action :set_test_name, except: [:index]

  def index
    begin
      @order = Order::Robust.find(params[:order]) if params[:order].present?
    rescue

    end

  end

  def sha
    #@policy = ['595ccd142a89a557', '31.10','1000024','20140130165700','1','CIS0ET14'].map{|i| [i.mb_chars.length, i].join}.join
    @policy = ''
    #afb511f483e25d47bd5a69081807511296cef3bf
    #@policy = Base64.strict_encode64(@policy)

    key = '0732D0F58CFDDFCA492DE86A872D033E'

    @signature = OpenSSL::HMAC.hexdigest('sha1', key, @policy)

    abort @signature.upcase
  end

  def card
  end

  def mac

  end

  def rstrip_or_self!(str)
    str.rstrip! || str
  end

  def result
    @logger = Logger.new("#{Rails.root}/log/#{Date.today.to_s}_acquire.log")
    @logger.formatter = proc do |severity, datetime, progname, msg|
      "#{datetime}: #{msg}\n"
    end

    good_params = Hash.new
    params.each_key do |k|
      good_key = k.rstrip || k
      good_params["#{good_key}"] = params[k].gsub("\n", "")
    end

    Rails.logger.info "PYANGYONG_GATES!!!!!!"
    Rails.logger.info good_params.to_s
    Rails.logger.info "=--=====----=-==-"
    Rails.logger.info good_params["EMAIL"].to_s
    Rails.logger.info "!!!!!!"

    @cart = Order.find_by_id(good_params["ORDER"].to_i)

    OrderMailer.order(@cart, good_params).deliver


    abort params.inspect
  end

  private
  def set_test_name
    @test_name = params[:test]
  end

  def set_config
    @config = {
        'URL' => 'https://109.73.41.78:5443/cgi-bin/cgi_link',
        'BACKREF' => admin_acquiring_result_url,
        'EMAIL' => 'ilya.doroshin@gmail.com',

        # transaction type
        'TRTYPE' => 1,
        'TERMINAL' => 'CIS0ET14',
        'MERCHANT' => 'EPB3000E30001PB',
        'MERCH' => 'lllooch',

        # return link!
        'MERCH_URL' => 'http://www.lllooch.ru'
    }

    @cards = {
        mastercard: {
            '21_1' => ['mastercard 1', '5454210002686041', '1511', 'ONE PRBB', '051', '12345678'],
            '21_2' => ['mastercard 2', '5454210002696495', '1511', 'TWO PRBB', '797', '12345678'],
            '21_3' => ['mastercard 3', '5454210002640147', '1511', 'THREE PRBB', '867'],
            '21_4' => ['mastercard 4', '5454210002551591', '1511', 'FOUR PRBB', '418'],
            '21_5' => ['mastercard 5', '5454210002708563', '1511', 'FIVE PRBB', '291'],
            '21_6' => ['mastercard 6', '5454210002596414', '1511', 'SIX PRBB', '629'],
            '21_7' => ['mastercard 7', '5454210002809189', '1511', 'SEVEN PRBB', '273'],
            '21_8' => ['mastercard 8', '5454210002281397', '1511', 'EIGHT PRBB', '844'],
            '21_9' => ['mastercard 9', '5454210002382567', '1511', 'NINE PRBB', '442'],
            '22_0' => ['mastercard 10', '5454210002225055', '1511', 'TEN PRBB', '859']
        }
    }

  end
end

# visa 1        4058444115434444  1511 ONE PRBBVISA     396   12345678
# visa 2        4058444162615002  1511 TWO PRBBVISA     132   12345678
# visa 3        4058444109795560  1511 THREE PRBBVISA   423
# visa 4        4058444156976121  1511 FOUR PRBBVISA    414
# visa 5        4058444104156685  1511 FIVE PRBBVISA    448
# visa 6        4058444151337246  1511 SIX PRBBVISA     994
# visa 7        4058444198517800  1511 SEVEN PRBBVISA   548
# visa 8        4058444145698364  1511 EIGHT PRBBVISA   846
# visa 9        4058444192878927  1511 NINE PRBBVISA    782
# visa 10       4058444168253881  1511 TEN PRBBVISA     176