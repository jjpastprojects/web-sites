# The ID of the waiting list
Rails.configuration.waiting_list_email_id = ENV['MAIL_CHIMP_WAITING_LIST_ID']

Gibbon::API.api_key = ENV['MAIL_CHIMP_API_KEY']
Gibbon::API.timeout = 15
Gibbon::API.throws_exceptions = false
