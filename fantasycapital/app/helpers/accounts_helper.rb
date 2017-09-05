module AccountsHelper

  def only_us_and_canada_regions
    Carmen::Country.coded('US').subregions + Carmen::Country.coded('CA').subregions
  end

  def balanced_marketplace_uri
    Rails.configuration.balanced_marketplace_uri
  end
end
