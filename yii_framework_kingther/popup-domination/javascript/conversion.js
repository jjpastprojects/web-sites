;(function(){

	$(document).ready(function(){
		var cururl = window.location;
		var abcookie = get_cookie("popup_dom_split_optin");
		var abid = get_cookie("popup_domination_ab");
		var camp = get_cookie("popup_domination_lightbox");
		var url = get_cookie("popup_dom_url");
		if(abcookie == 'Y'){
			var popupid = get_cookie("popup_domination_lightbox");
			$.post(url+"js.php", { 
				action : 'ajax',
				dothis : 'ab_optin',
				campaignid: camp,
				popupid : abid 
			}, function(data) {
			   document.cookie = 'popup_dom_split_show' + '=; expires=Thu, 01-Jan-70 00:00:01 GMT;';
			});
		}
	});
	
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