(function($){
	$.fn.extend({
		sharer: function(options) {		
			var defaults = {
				popup: {
					width: 					550,
					height: 				600,
					toolbar: 				0,
					scrollbars: 			0,
					menubar: 				0,
					left: 					100,
					top: 					100,
					target: 				'_blank',
					resizable: 				0,
					status: 				0
				},

				bind_to_links: 			true,

				url: document.URL,

				networks: {
					facebook: {
						url: 'http://www.facebook.com/sharer.php?m2w&s=100&p[url]='
					},

					twitter: {
						url: 'https://twitter.com/intent/tweet?text=' + encodeURIComponent(document.title) + '&url='
					},

					linkedin: {
						url: 'http://www.linkedin.com/shareArticle?mini=true&title=' + encodeURIComponent(document.title) + '&url='
					},

					google: {
						url: 'https://plus.google.com/share?url='
					},

					pinterest: {
						url: 'http://pinterest.com/pin/create/button/?description='+ encodeURIComponent(document.title) + '&url='
					}
				},

				image_url: ''
			}	

			var settings 		= $.extend(defaults, options);

			function open_window()
			{	
				window.open(
					get_share_url.call(this), settings.popup.target, popup_params()
				);
			}
			

			function popup_params()
			{
				var arr_params = [];

				$.each(settings.popup, function(k, value) {
					arr_params.push(k + '=' + value)
				});

				return arr_params.join(',');
			}
			
			function set_setting(key, value)
			{
				settings[key] = value;
			}

			function get_share_url()
			{
				var url = this.url + encodeURIComponent(settings.url);

				if(settings.network == 'pinterest')
				{
					url += '&media=' + encodeURIComponent(
						settings.image_url
					);
				}

				return url;
			}

			return {
				init: function()
				{
					if(settings.bind_to_links)
					{
						$(this).each(function(i,v) {
							var $this = $(this);
							
							$.each(settings.networks, function(key, network) {
								$this.find('[data-sharer-network="' + key + '"]').off('click').on('click', function(e) {
									e.preventDefault();
									open_window.call(network);
								});
							});
						});	
					}
				},

				open_window: function ()
				{
					open_window.call(this);
				},

				set_setting: function(k, v)
				{
					set_setting(k, v);	
				},

				share_via: function(network, url)
				{
					settings.url = url;
					open_window.call(settings.networks[network]);
				},

				get_share_url: function(network, url, image_url)
				{
					settings.network 	= network;
					settings.url 		= url;
					settings.image_url 	= image_url;

					return get_share_url.call(settings.networks[network]);
				},

				settings: settings

			}
		}
	});
})(jQuery);