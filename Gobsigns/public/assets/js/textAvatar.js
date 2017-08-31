(function ($) {
	$.fn.nameBadge = function (options) {
		var settings = $.extend({
			border: {
				color: '#ddd',
				width: 0
			},
			colors: ['#458b00', '#f85931', '#ce1836', '#009989','#00688b','#8b1a1a'],
			text: '#fff',
			size: 57,
			margin: 2,
			middlename: true,
			uppercase: true,
			max: 3,
		}, options);
		return this.each(function () {
			var elementText = $(this).text();
			if(!elementText.trim())
			elementText = 'User';
			var initialLetters = elementText.match(settings.middlename ? /\b(\w)/g : /^\w|\b\w(?=\S+$)/g);
			var initials = initialLetters.join('');
			initials = initials.substr(0, settings.max);
			$(this).text(initials);
			$(this).css({
				'color': settings.text,
				'background-color': settings.colors[Math.floor(Math.random() * settings.colors.length)],
				'border': settings.border.width + 'px solid ' + settings.border.color,
				'display': 'inline-block',
				'font-family': 'Arial, \'Helvetica Neue\', Helvetica, sans-serif',
				'font-size': settings.size * 0.4,
				'border-radius': settings.size + 'px',
				'width': settings.size + 'px',
				'height': settings.size + 'px',
				'line-height': settings.size + 'px',
				'margin': settings.margin + 'px',
				'text-align': 'center',
				'float' : 'left',
				'text-transform' : settings.uppercase ? 'uppercase' : ''
			});
		});
	};
}(jQuery));