window.Account =
  initBankWithdrawal: ->
    $('#withdrawal').click ->
      bankId = $('#bank_id').val()
      amount = $('#amount').val()
      promise = $.post '/accounts/bank_accounts/withdrawal', bank_id: bankId, amount: amount
      promise.success ->
        window.location.href = '/accounts/profile'
      false

