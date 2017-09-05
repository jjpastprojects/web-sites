;(function($){
	var timer, exit_shown = false;
	$(window).load(function(){
		if(check_cookie()){
			return false;
		}
		if(popup_domination_impression_count > 0){
			if(check_impressions()){
				return false;
			}
		}
		$(document).find('body').prepend(popup_domination_output);
		switch(popup_domination_show_opt){
			case 'mouseleave':
				$(window).mouseleave(show_lightbox);
				break;
			case 'unload':
				enable_unload();
				break;
			default:
				if(popup_domination_delay && popup_domination_delay > 0){
					timer = setTimeout(show_lightbox,(popup_domination_delay*1000));
				} else {
					show_lightbox();
				}
				break;
		}
		init_center();
		if(popup_domination_defaults){
			var defaults = popup_domination_defaults;
			for(var i in defaults){
				if($.trim(defaults[i]) != ''){
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
		$('#popup_domination_lightbox_close').click(function(){
			close_box();
			return false;
		});
		$('#popup_domination_lightbox_wrapper form').submit(function(){
			var checked = true;
			$('#popup_domination_lightbox_wrapper :text').each(function(){
				var $this = $(this), val = $this.val();
				if($this.data('default_value') && val == $this.data('default_value')){
					if(checked)
						$this.val('').focus();
					checked = false;
				}
				if(val == ''){
					checked = false;
				}
			});
			if(checked){
				close_box();
				return true;
			}
			return false;
		});
	});
	

	
	function enable_unload(){
		var oldunload = window.onbeforeunload, oldunload2 = window.onunload;
		if(typeof oldunload != 'function'){
			oldunload = null;
		}
		if(typeof oldunload2 != 'function'){
			oldunload2 = null;
		}
		window.onbeforeunload = function(e){ 
			if(exit_shown === false){
				e = e || window.event;
				exit_shown = true;
				$(document).focus(function(){ timer = setTimeout(show_lightbox,1000)});
				window.onunload = function(){
					close_box(false);
					if(oldunload2 !== null){
						window.onunload = oldunload2;
						return oldunload2();
					}
				}
				window.onbeforeunload = oldunload;
				if(e)
					e.returnValue = popup_domination_unload_msg;
				return popup_domination_unload_msg; 
			}
		};
	};
	function show_lightbox(){
		$(document).unbind('focus',show_lightbox);
		max_zindex();
		$('#popup_domination_lightbox_wrapper').fadeIn('fast');
		center_it();
	};
	function center_it(){
		$('.popup-dom-lightbox-wrapper .lightbox-main').css({
			position:'absolute',
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
	function close_box(fade){
		fade = fade === false ? false : true;
		var elem = $('#popup_domination_lightbox_wrapper');
		clearTimeout(timer);
		if(fade){
			elem.fadeOut('fast');
			if(popup_domination_cookie_time && popup_domination_cookie_time > 0){
				var date = new Date();
				date.setTime(date.getTime() + (popup_domination_cookie_time*86400*1000));
				set_cookie('popup_domination_hide_lightbox','Y',date);
			}
		} else {
			elem.hide();
		}
	};
	function set_cookie(name,value,date){
		window.document.cookie = [name+'='+escape(value),'expires='+date.toUTCString(),'path='+popup_domination_cookie_path].join('; ');
	};
	function check_cookie(){
		if(get_cookie('popup_domination_hide_lightbox') == 'Y')
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
})(jQuery);