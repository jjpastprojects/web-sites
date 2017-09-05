
class AjaxModal
  url: ''
  modal: ''

  constructor: (url)->
    @url = url

  load: (callback)->
    @modal = @createModal()
    that = @
    $('body').modalmanager('loading');
    @modal.load @url, '', ->
      that.modal.modal()
      callback(that.modal) if callback?

  getModal: ->
    @modal

  createModal: ->
    $('#ajax-modal').remove() if $('#ajax-modal').length > 0

    $("<div />",
      id: "ajax-modal"
      class: "modal fade"
      tabindex: "-1"
      role: "dialog"
      "aria-labelledby": "ajax-modal"
      "aria-hidden": "true"
    ).appendTo "body"

    $('#ajax-modal')

class AjaxModal4Container
  url: ''
  modal: ''

  constructor: (url)->
    @url = url

  load: (callback)->
    @modal = @createModal()
    that = @
    $('body').modalmanager('loading');
    @modal.load @url, '', ->
      that.modal.modal()
      callback(that.modal) if callback?

  getModal: ->
    @modal

  createModal: ->
    $('#ajax-modal').remove() if $('#ajax-modal').length > 0

    $("<div />",
      id: "ajax-modal"
      class: "modal fade container"
      tabindex: "-1"
      role: "dialog"
      "aria-labelledby": "ajax-modal"
      "aria-hidden": "true"
    ).appendTo "body"

    $('#ajax-modal')

$(document).on "ready page:load": ->
  window.AjaxModal = AjaxModal
  window.AjaxModal4Container = AjaxModal4Container

