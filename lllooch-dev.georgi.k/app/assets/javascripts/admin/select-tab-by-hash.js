var TabByHash = {
	select: function(hash) {
		$('li').not('.disabled').find('a[href=' + hash + ']').tab('show');
	},
	init: function() {
		if (location.hash !== '') $('li').not('.disabled').find('> a[href="' + location.hash + '"]').tab('show');
	}
};

var Tabbable = function(el) {
	el.on('click', function(e) {
		if (0 != el.closest('li.disabled').size())
		{
			e.preventDefault();
			return false;
		}

	});

	el.on('shown', function(e) {
		location.hash = $(e.target).attr('href');
	});
};

$(function() {
	$('[data-toggle=tab]').each(function() {
		new Tabbable($(this));
	});

	$(window).on('hashchange', function() {
		TabByHash.select(window.location.hash);
	});

	TabByHash.init();
});