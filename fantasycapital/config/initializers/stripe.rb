if Rails.env.production? || Rails.env.development?
  Rails.configuration.stripe = {
    :publishable_key => ENV['STRIPE_PUBLISHABLE_KEY'],
    :secret_key  => ENV['STRIPE_SECRET_KEY'],
    :fc_op_stripe_recipient_id => ENV['STRIPE_FC_OP_RECIPIENT_ID'],
    :fc_op_stripe_customer_id => ENV['STRIPE_FC_OP_CUSTOMER_ID']
  }
else
  # Stripe (these are test keys only so they are safe)
  Rails.configuration.stripe = {
    :publishable_key => 'pk_test_BmYJ7lge4AeP0sKdsle7K93A',
    :secret_key => 'sk_test_EYDrd5oqAgSNqb0iynt0khNI',
    :fc_op_stripe_recipient_id => 'rp_103x5C2rS7Xj8jXACfdhGE8x',
    :fc_op_stripe_customer_id => 'cus_3x5BYjHONuDulZ'
  }
end
Stripe.api_key = Rails.configuration.stripe[:secret_key]

