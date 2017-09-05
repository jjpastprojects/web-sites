require 'dellin_api'

namespace :dellin do
  desc 'Download cities list'
  task cities: :environment do
    dellin = DellinApi.new
    dellin.get_kladrs

    puts ['Cities added: ', Kladr.all.size].join ''
  end
end
