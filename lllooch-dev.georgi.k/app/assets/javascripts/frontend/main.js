var _document = function(_window) {
	var body   = $('body'),
		width  = 0,
		height = 0
	;

	var resizedHeight = function(h) {
		height = h;
		body.trigger('resize:height');
	};

	var resizedWidth = function(w) {
		width = w;
		body.trigger('resize:width');
	};

	var resizeListener = function() {
		$(window).resize(function() {
			var _height = body.height(),
				_width  = body.width()
			;

			if (height != _height) resizedHeight(_height);
			if (width  != _width)  resizedWidth(_width);
		});
	};

	var init = function() {
		resizeListener();
	};

	$(function() {
		init();
	});
};

$(document).on('ready page:load', function() {
    var Document = new _document(this);
});


