# Note this file will be included in *all* pages.
$(document).on "ready page:load": ->
	$('.createnewlineups').click ->
    $('.new-lineup-popup').toggle()
    $('.new-lineup-popup .choices li a').removeClass('selected')

    $('.new-lineup-popup .btnClose').click ->
    	$('.new-lineup-popup').hide()

    $('.new-lineup-popup .cancel').click ->
    	$('.new-lineup-popup').hide()

    $('.new-lineup-popup .sport-list li a').click ->
    	$('.new-lineup-popup .sport-list li a.selected').removeClass('selected');
    	$(this).addClass('selected');

    $('.new-lineup-popup .time-list li a').click ->
    	$('.new-lineup-popup .time-list li a.selected').removeClass('selected');
    	$(this).addClass('selected');

    $(".lineup-export").click ->
        new window.AjaxModal4Container($(@).data('stats-url')).load();
