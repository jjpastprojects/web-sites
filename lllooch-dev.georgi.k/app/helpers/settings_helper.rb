module SettingsHelper
  def S(key, default='')
    setting = Setting.find_by_key(key)

    unless setting.present?
      setting = Setting.create(key: key, value: default)
    end

    setting.value
  end
end
