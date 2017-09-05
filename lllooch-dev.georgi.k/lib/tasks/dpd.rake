require 'dpd_api'

namespace :dpd do
  desc 'Download cities list'
  task cities: :environment do
    dpd = DpdApi.new
    dpd.get_cities

    puts ['Cities added: ', DpdCity.all.size].join ''
  end
end
