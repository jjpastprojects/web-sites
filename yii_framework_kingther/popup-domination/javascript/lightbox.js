function popdombackupjquery() {

;(function($){
	var jquery_loaded = false, popdom_jq, timer, exit_shown = false;
    function load_jquery() {
        var j = document.createElement('script');
        j.setAttribute('id', 'popdom_jquery');
        j.setAttribute('src', 'http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js');
        j.onreadystatechange = function () {
            if (this.readyState == 'complete' || this.readyState == 'loaded') {
                if (!jquery_loaded) {
                    jquery_loaded = true;
                    popdom_jq = jQuery.noConflict(true);
                    init(popdom_jq);
                }
            }
        };
        j.onload = function () {
            if (!jquery_loaded) {
                jquery_loaded = true;
                popdom_jq = jQuery.noConflict(true);
                init(popdom_jq);
            }
        };
        document.getElementsByTagName('body')[0].appendChild(j);
    };

    function addLoadListener(fn) {
        if (typeof window.addEventListener != 'undefined') window.addEventListener('load', fn, false);
        else if (typeof document.addEventListener != 'undefined') document.addEventListener('load', fn, false);
        else if (typeof window.attachEvent != 'undefined') window.attachEvent('onload', fn);
        else {
            if (typeof window.onload != 'function') window.onload = fn;
            else {
                var oldfn = window.onload;
                window.onload = function () {
                    oldfn();
                    fn();
                };
            }
        }
    };
	
	function init($){
		function enable_unload(){
			$(window).bind('beforeunload',function(e){ 
				if(exit_shown === false){
					e = e || window.event;
					exit_shown = true;
					setTimeout(show_lightbox,1000);
					$(window).bind('unload',function(){
						close_box(popup_domination_popupid);
					});
					if(e)
						e.returnValue = popup_domination_unload_msg;
					return popup_domination_unload_msg; 
				}
			});
		};
		function window_mouseout(e){
			var mX = e.pageX, mY = e.pageY, el = $(document).find('body');
			if((mY >= 0 && mY <= el.outerHeight()) && (mX >= 0 && mX <= el.outerWidth())){
				return;
			}
			show_lightbox();
		};
		function show_lightbox(){
		    var isMobile = false;
            if (window.screen.availWidth <= 767) {
                //smartphones
                isMobile = true;
            }
            if (window.screen.availWidth > 767 && window.screen.availWidth <= 1024) {
                //tablets
                isMobile = true;
            }
            if (isMobile) return false;
			$(document).unbind('focus',show_lightbox);
			$('html,body').unbind('mouseout', window_mouseout);
			if(!check_cookie(popup_domination_popupid)){
				max_zindex();
				$('#popup_domination_lightbox_wrapper').fadeIn('fast');
				center_it();
				if(check_split_cookie() == true){				
					var date = new Date();
					date.setTime(date.getTime() + (86400*1000));
					set_cookie('popup_dom_split_show','Y', date);
					set_cookie('popup_domination_lightbox',popup_domination_popupid,date);
					var campid = popup_domination_abid;
					var data = {
  						action: 'ajax',
  						dothis: 'ab_show',
  						popupid: popup_domination_abid,
  						campaignid : popup_domination_popupid
  					}
  					jQuery.post(popup_domination_url+'js.php', data);
				}else{
					if(check_cookie(popup_domination_popupid) != 'true'){
						var data = {
		  						action: 'ajax',
		  						dothis: 'show',
		  						campaignid: popup_domination_popupid
		  					}
		  				jQuery.post(popup_domination_url+'js.php?callback=', data);
	  				}
				}
			}
			var provider = $('.lightbox-signup-panel .provider').val();
			if(provider == 'aw'){
				var html = $('#popup_domination_lightbox_wrapper #removeme').html();
				$('#popup_domination_lightbox_wrapper #removeme').remove();
				if($('#popup_domination_lightbox_wrapper .form form').html() == null){
					$('#popup_domination_lightbox_wrapper .form div').prepend('<form method="post" action="http://www.aweber.com/scripts/addlead.pl"></form>')
					$('#popup_domination_lightbox_wrapper .form div form').prepend(html);
				}
			}
			
			if($("#fb-root").length > 0 && typeof popup_domination_fb_id !== "undefined"){
				facebook(popup_domination_fb_id);
			}
		};
		
		function facebook(id) {
	      window.fbAsyncInit = function() {
	        FB.init({
	          appId: id,
	          cookie: true,
	          xfbml: true,
	          oauth: true
	        });
	        FB.Event.subscribe('auth.login', function(response) {
	          window.location.reload();
	        });
	      };
	      (function() {
	        var e = document.createElement('script'); e.async = true;
	        e.src = document.location.protocol +
	          '//connect.facebook.net/en_US/all.js';
	        document.getElementById('fb-root').appendChild(e);
	      }());
	     }
      
		function center_it(){
			$('.popup-dom-lightbox-wrapper .lightbox-main').css({
				position:'fixed',
				left: ($(window).width() - $('.popup-dom-lightbox-wrapper .lightbox-main').outerWidth())/2,
				top: ($(window).height() - $('.popup-dom-lightbox-wrapper .lightbox-main').outerHeight())/2
			});
		}
		function init_center(){
			center_it();
			$(window).resize(center_it);
		};
		function max_zindex(){
			var maxz = 0;
			$('body *').each(function(){
				var cur = parseInt($(this).css('z-index'));
				maxz = cur > maxz ? cur : maxz;
			});
			$('#popup_domination_lightbox_wrapper').css('z-index',maxz+10);
		};
		function close_box(popup_domination_popupid){
			fade = true;
			var elem = $('#popup_domination_lightbox_wrapper');
			clearTimeout(timer);
			elem.fadeOut('fast');
			if(popup_domination_cookie_time && popup_domination_cookie_time > 0){
				var date = new Date();
				date.setTime(date.getTime() + (popup_domination_cookie_time*86400*1000));
				if(popup_domination_popupid == '0'){
					popup_domination_popupid = 'zero';
				}else if(popup_domination_popupid == '1'){
					popup_domination_popupid = 'one';
				}else if(popup_domination_popupid == '3'){
					popup_domination_popupid = 'three';
				}else if(popup_domination_popupid == '4'){
					popup_domination_popupid = 'four';
				}
					
				set_cookie('popup_domination_hide_lightbox'+popup_domination_popupid,'Y',date);
			}
		};
		
		function opt_in(popup_domination_popupid){
			fade = true;
			var elem = $('#popup_domination_lightbox_wrapper');
			clearTimeout(timer);
			elem.fadeOut('fast');
			if(popup_domination_cookie_time && popup_domination_cookie_time > 0){
				var date = new Date();
				date.setTime(date.getTime() + (popup_domination_cookie_time*86400*5000000));
				if(popup_domination_popupid == '0'){
					popup_domination_popupid = 'zero';
				}else if(popup_domination_popupid == '1'){
					popup_domination_popupid = 'one';
				}else if(popup_domination_popupid == '3'){
					popup_domination_popupid = 'three';
				}else if(popup_domination_popupid == '4'){
					popup_domination_popupid = 'four';
				}
					
				set_cookie('popup_domination_hide_lightbox'+popup_domination_popupid,'Y',date);
			}
		};
		
		function set_cookie(name,value,date){
			window.document.cookie = [name+'='+escape(value),'expires='+date.toUTCString(),'path='+popup_domination_cookie_path].join('; ');
		};
		function check_cookie(popup_domination_popupid){
			if(popup_domination_popupid == '0'){
				popup_domination_popupid = 'zero';
			}else if(popup_domination_popupid == '1'){
				popup_domination_popupid = 'one';
			}else if(popup_domination_popupid == '3'){
				popup_domination_popupid = 'three';
			}else if(popup_domination_popupid == '4'){
				popup_domination_popupid = 'four';
			}
			if(get_cookie('popup_domination_hide_lightbox'+popup_domination_popupid) == 'Y')
				return true;
			return false;
		};
		function check_impressions(){
			var ic = 1, date = new Date();
			if(ic = get_cookie('popup_domination_icount')){
				ic = parseInt(ic);
				ic++;
				if(ic == popup_domination_impression_count){
					date.setTime(date.getTime());
					set_cookie('popup_domination_icount',popup_domination_impression_count,date);
					return false;
				}
			} else {
				ic = 1;
			}
			date.setTime(date.getTime() + (7200*1000));
			set_cookie('popup_domination_icount',ic,date);
			return true;
		};
		
		
		function get_cookie(cname){
			var cookie = window.document.cookie;
			if(cookie.length > 0){
				var c_start = cookie.indexOf(cname+'=');
				if(c_start !== -1){
					c_start = c_start + cname.length+1;
					var c_end = cookie.indexOf(';',c_start);
					if(c_end === -1)
						c_end = cookie.length;
					return unescape(cookie.substring(c_start,c_end));
				}
			}
			return false;
		};
		
		if(check_cookie(popup_domination_popupid)){
			return false;
		}
		if(popup_domination_impression_count > 1){
			if(check_impressions()){
				return false;
			}
		}
		
		$(document).find('body').prepend(popup_domination_output);
		switch(popup_domination_show_opt){
			case 'mouseleave':
				$('html,body').mouseout(window_mouseout);
				break;
			case 'unload':
				enable_unload();
				break;
			default:
				if(delay && delay > 0){
					timer = setTimeout(show_lightbox,(delay*1000));
				} else {
					show_lightbox();
					var provider = $('.lightbox-signup-panel .provider').val();
					if(provider == 'aw'){
						var html = $('#popup_domination_lightbox_wrapper #removeme').html();
						$('#popup_domination_lightbox_wrapper #removeme').remove();
						if($('#popup_domination_lightbox_wrapper .form form').html() == null){
							$('#popup_domination_lightbox_wrapper .form div').prepend('<form method="post" action="http://www.aweber.com/scripts/addlead.pl"></form>')
							$('#popup_domination_lightbox_wrapper .form div form').prepend(html);
						}
					}
				}
				break;
		}
		init_center();
		if(popup_domination_defaults){
			var defaults = popup_domination_defaults;
			for(var i in defaults){
				if($.trim(defaults[i]) != ''){
					$('#popup_domination_lightbox_wrapper .form :text'+i)
						.data('default_value',defaults[i])
						.focus(function(){
							var $this = $(this);
							if($this.val() == $this.data('default_value'))
								$this.val('');
						}).blur(function(){
							var $this = $(this);
							if($this.val() == '')
								$this.val($this.data('default_value'));
						});
					$('#popup_domination_lightbox_wrapper form :text'+i)
						.data('default_value',defaults[i])
						.focus(function(){
							var $this = $(this);
							if($this.val() == $this.data('default_value'))
								$this.val('');
						}).blur(function(){
							var $this = $(this);
							if($this.val() == '')
								$this.val($this.data('default_value'));
						});
				}
			}
		}
		
		$('.lightbox-overlay').click(function(){
			close_box(popup_domination_popupid);
			return false;
		});
		
		$('#popup_domination_lightbox_close').click(function(){
			close_box(popup_domination_popupid);
			return false;
		});
		$('#popup_domination_opt_in').click(function(){
			opt_in(popup_domination_popupid);
			return false;
		});
		
		var provider = $('.lightbox-signup-panel .provider').val();
		if(provider == 'aw'){
			$('#popup_domination_lightbox_wrapper .form div').append('</form>');
		};
		
		
		$('#popup_domination_lightbox_wrapper input[type="submit"]').click(function(){
			var checked = false;
			$('#popup_domination_lightbox_wrapper :text').each(function(){
				var $this = $(this), val = $this.val();
				if($this.data('default_value') && val == $this.data('default_value')){
					if(checked)
						$this.val('').focus();
					checked = false;
				}
				if(val == ''){
						checked = false;
				}else{
						checked = true;
				}
			});
			
			if(checked){
				var email = $('.lightbox-signup-panel .email').val();
				var name = $('.lightbox-signup-panel .name').val();
				var custom1 = $('.lightbox-signup-panel .custom1_input').val();
				var custom2 = $('.lightbox-signup-panel .custom2_input').val();
				var customf2 = $('.lightbox-signup-panel .custom_id2').val();
				var customf1 = $('.lightbox-signup-panel .custom_id1').val();
				var listid = $('.lightbox-signup-panel .listid').val();
				var provider = $('.lightbox-signup-panel .provider').val();
				$('#popup_domination_lightbox_wrapper input[type="submit"]').attr('disabled', 'disabled');
				$('#popup_domination_lightbox_wrapper .form input').fadeOut();
				$('#popup_domination_lightbox_wrapper .wait').fadeIn();
				//var dataString = 'name='+ name + '&email='+ email + '&listid='+listid;
				if(provider != 'form' && provider != 'aw' && provider != 'nm'){
					var data = {
						action: 'ajax',
						dothis: 'mailing',
						name: name,
						email: email,
						custom1: custom1,
						custom2: custom2,
						customf1: customf1,
						customf2: customf2,
						provider: provider,
						listid: listid
					};
					
					jQuery.post(popup_domination_url+"js.php", data, function(response) {
						if(response.length > 4){
							$('#popup_domination_lightbox_wrapper input[type="submit"]').removeAttr('disabled', 'disabled');
							$('#popup_domination_lightbox_wrapper .form input').fadeIn();
							$('#popup_domination_lightbox_wrapper .wait').fadeOut();
						}else{
							opt_in(popup_domination_popupid);
							if(check_split_cookie() != true){
								var data = {
				  						action: 'ajax',
				  						dothis: 'optin',
				  						popupid: popup_domination_popupid
				  					}
				  				jQuery.post(popup_domination_url+"js.php?callback=", data, function(){
				  					if(popup_domination_redirect.length > 1){
				  						window.location.href = decodeURIComponent(popup_domination_redirect);
				  					}
				  				});
			  				}else{
			  					ab_set_cookie();
								var data = {
				  						action : 'ajax',
										dothis : 'ab_optin',
										campaignid: popup_domination_abid,
										popupid : popup_domination_popupid 
				  					}
				  				jQuery.post(popup_domination_url+"js.php?callback=", data, function(){
				  					if(popup_domination_redirect.length > 1){
				  						window.location.href = decodeURIComponent(popup_domination_redirect);
				  					}
				  				});
			  				}
							
						}
					});
				}else{
					if(check_split_cookie() != true){
						opt_in(popup_domination_popupid);
						var data = {
		  						action: 'ajax',
		  						dothis: 'optin',
		  						popupid: popup_domination_popupid
		  					}
		  				jQuery.post(popup_domination_url+"js.php?callback=", data, function(){
							$('.lightbox-signup-panel form').submit();		  					
		  				});
		  				return false;
		  			}else{
		  				ab_set_cookie();
		  				var data = {
		  						action: 'ajax',
		  						dothis: 'ab_optin',
		  						campaignid: popup_domination_abid,
								popupid : popup_domination_popupid 
		  					}
		  				jQuery.post(popup_domination_url+"js.php?callback=", data, function(){
		  					$('.lightbox-signup-panel form').submit();
		  				});
		  				opt_in(popup_domination_popupid);
		  			}
		  			return false;
				}
				
			}
			return false;
		});

		$('#popup_domination_lightbox_wrapper .sb_facebook').click(function(){
			if($(this).hasClass('got_user') == true){
				var email = $('.lightbox-signup-panel .fbemail').val();
				var name = $('.lightbox-signup-panel .fbname').val();
				var custom1 = $('.lightbox-signup-panel .custom1_input').val();
				var custom2 = $('.lightbox-signup-panel .custom2_input').val();
				var customf2 = $('.lightbox-signup-panel .custom_id2').val();
				var customf1 = $('.lightbox-signup-panel .custom_id1').val();
				var listid = $('.lightbox-signup-panel .listid').val();
				var provider = $('.lightbox-signup-panel .provider').val();
				$('#popup_domination_lightbox_wrapper input[type="submit"]').attr('disabled', 'disabled');
				$('#popup_domination_lightbox_wrapper .form input').fadeOut();
				$('#popup_domination_lightbox_wrapper .wait').fadeIn();
				//var dataString = 'name='+ name + '&email='+ email + '&listid='+listid;
				if(provider != 'form' && provider != 'aw' && provider != 'nm'){
					var data = {
						action: 'ajax',
						dothis: 'mailing',
						name: name,
						email: email,
						custom1: custom1,
						custom2: custom2,
						customf1: customf1,
						customf2: customf2,
						provider: provider,
						listid: listid
					};
					
					jQuery.post(popup_domination_url+"js.php", data, function(response) {
						if(response.length > 4){
							$('#popup_domination_lightbox_wrapper input[type="submit"]').removeAttr('disabled', 'disabled');
							$('#popup_domination_lightbox_wrapper .form input').fadeIn();
							$('#popup_domination_lightbox_wrapper .wait').fadeOut();
						}else{
							opt_in(popup_domination_popupid);
							if(check_split_cookie() != true){
								var data = {
				  						action: 'ajax',
				  						dothis: 'optin',
				  						popupid: popup_domination_popupid
				  					}
				  				jQuery.post(popup_domination_url+"js.php", data, function(){
				  					if(popup_domination_redirect.length > 1){
				  						window.location.href = decodeURIComponent(popup_domination_redirect);
				  					}
				  				});
			  				}else{
			  					ab_set_cookie();
								var data = {
				  						action: 'ajax',
				  						dothis: 'ab_optin',
				  						popupid: popup_domination_popupid
				  					}
				  				jQuery.post(popup_domination_url+"js.php", data, function(){
				  					if(popup_domination_redirect.length > 1){
				  						window.location.href = decodeURIComponent(popup_domination_redirect);
				  					}
				  				});
			  				}
							
						}
					});
				}else{
					$('#popup_domination_lightbox_wrapper .name').val(name);
					$('#popup_domination_lightbox_wrapper .email').val(email);
					if(check_split_cookie() != true){
						opt_in(popup_domination_popupid);
						var data = {
		  						action: 'ajax',
		  						dothis: 'optin',
		  						popupid: popup_domination_popupid
		  					}
		  				jQuery.post(popup_domination_url+"js.php", data, function(){
							$('.lightbox-signup-panel form').submit();		  					
		  				});
		  				return false;
		  			}else{
		  				ab_set_cookie();
		  				var data = {
		  						action: 'ajax',
		  						dothis: 'ab_optin',
		  						popupid: popup_domination_popupid
		  					}
		  				jQuery.post(popup_domination_url+"js.php", data, function(){
		  					$('.lightbox-signup-panel form').submit();
		  				});
		  				opt_in(popup_domination_popupid);
		  			}
		  			return false;
				}
				
			}
			return false;
		});
		
		function check_split_cookie(){
			 if(popup_domination_abcookie == 'true'){
			 	return true;
			 }else{
			 	return false;
			 }
		}
		
		function ab_set_cookie(){
			if(check_split_cookie() == true){
				var date = new Date();
				date.setTime(date.getTime() + (86400*1000));

				//set_cookie('popup_domination_split_lightbox_show','YES',date);
				set_cookie('popup_dom_split_optin','Y', date);
				set_cookie('popup_dom_url',popup_domination_url, date);
				set_cookie('popup_domination_ab', popup_domination_abid, date);
				set_cookie('popup_domination_lightbox', popup_domination_popupid, date);
				if(popup_domination_redirect.length > 1){
					window.location.href = decodeURIComponent(popup_domination_redirect);
				}
			}else{
				analytics_optin();
			}
		}
		
		function analytics_optin(){
			$.post(popup_domination_url+"js.php", { 
				action : 'ajax',
				dothis : 'optin',
				campaignid: popup_domination_popupid
			},function(data) {
				if(data == 'true'){
					if(popup_domination_redirect.length > 1){
						window.location.href = decodeURIComponent(popup_domination_redirect);
					}
				}else{
					return false;
				}
			});
		}
		if($('.lightbox-signup-panel #fb-form').attr('title') == 'facebook'){
			var email = $('#fb-form .fbemail').val();
			var name = $('#fb-form .fbname').val();
			var provider = $('#fb-form .provider').val();
			if(provider != 'form'){
				var data = {
					action: 'popup_domination_lightbox_submit',
					name: name,
					email: email,
					provider: provider,
					listid: listid
				};
				
				jQuery.post(popup_domination_url+'js.php', data, function(response) {
					if(response.length > 4){
					}else{
						close_box(popup_domination_popupid);
						var popupid = popup_domination.popupid;
						var data = {
		  						action: 'popup_domination_analytics_add',
		  						stage: 'opt-in',
		  						popupid: popup_domination.popupid
		  					}
		  				jQuery.post(popup_domination_url+'js.php', data, function(){
		  					if(popup_domination_redirect.length > 1){
								window.location.href = decodeURIComponent(popup_domination_redirect);
							}
		  				});
						
					}
				});
			}else{
				$('.lightbox-signup-panel form').submit();
			}
		}
	};
	
    addLoadListener(function () {
        if (typeof jQuery == 'undefined') {
            load_jquery();
        } else {
			if(jQuery.fn.jquery < '1.6'){
				load_jquery();
			} else {
	            init(jQuery);
			}
        }
    });
})(jQuery);

}


if(typeof jQuery=='undefined') {
    var headTag = document.getElementsByTagName("head")[0];
    var jqueryTag = document.createElement('script');
    jqueryTag.type = 'text/javascript';
    jqueryTag.src = '//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js';
    jqueryTag.onload = popdombackupjquery;
    headTag.appendChild(jqueryTag);
} else {
     popdombackupjquery();
}
