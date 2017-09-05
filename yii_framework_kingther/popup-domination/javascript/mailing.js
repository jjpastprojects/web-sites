;(function($){
	var popup_domination_admin_ajax = 'index.php?section=ajax&action=ajax&do=mailinglist';
	$(document).ready(function(){
		cur_hash = get_hash(document.location.hash)
		if(cur_hash == '' || cur_hash == ' '){
			if(typeof provider != 'undefined' && provider != '' && provider!= ' '){
				$('#popup_domination_tabs a').each(function(){
					listalt = $(this).attr('alt');
					if(listalt == provider || provider == 'form' && listalt == 'other'){
						id = get_hash($(this).attr('href'));
						window.location.hash = id;
						init_tabs();
					}
				});
			}else{
				id = 'mailchimp';
				window.location.hash = id;
				init_tabs();
			}
		}else{
			init_tabs();
		}
		change_selects();
		$('#popup_domination_formhtml').change(function(){
			var nameval = $('#popup_domination_name_box_selected').val('');
			var emailval = $('#popup_domination_email_box_selected').val('');
			var custom1val = $('#popup_domination_custom1_box_selected').val('');
			var custom2val = $('#popup_domination_custom2_box_selected').val('');
			change_selects();
		});
		if($('#popup_domination_container .notices .message').text().length > 2){
			$('#popup_domination_container .notices').fadeIn('slow').delay(8000).fadeOut('slow');
		}
		$('.custom_num').change(function(){
			customnum = parseInt($(this).val());	
			if(customnum < 1){
				$('.custom2').val('').css('display','none');
				$('.custom1').val('').css('display','none');
			}
			if(customnum == 1){
				$('.custom1').val('').css('display','block');
				$('.custom2').val('').css('display','none');
			}
			if(customnum > 1){
				$('.custom1').css('display','block');
				$('.custom2').css('display','block');
			}
		});
		$('#landingpage').change(function(){
			$('#landingurl').attr('disabled',($(this).is(':not(:checked)')));
			//$('#popup_domination_name_box_selected').attr('disabled',($(this).is(':checked')));
			var checkcheck = $(this).attr('checked');
			if(checkcheck != 'checked'){
				$('.redirecturl').val('');
			}else{
				var redirecturl = $('#landingurl').val()
				$('.redirecturl').val(redirecturl);
			}
		});
		provider = $('.provider').val();
		if(provider == 'aw' || provider == 'other'){
			$('#form .disablename').hide();
			$('#form p').hide();
			$('.current-connect p').show();
		}else{
			$('#form .disablename').show();
			$('#form p').show();
		}
		$('.mailing-comps a').click(function(){
			provider = $('.tab-menu .selected').attr('alt');
			if(provider == 'aw' || provider == 'other'){
				$('#form .disablename').hide();
				$('#form p').hide();
				$('.current-connect p').show();
			}else{
				$('#form .disablename').show();
				$('#form p').show();
			}
			if(provider == 'nm'){
				$('.popdom-inner-sidebar form .custom1, .popdom-inner-sidebar form .custom2, .popdom-inner-sidebar form .apikey, .popdom-inner-sidebar form .username, .popdom-inner-sidebar form .password, .popdom-inner-sidebar form .apiextra, .popdom-inner-sidebar form .listname, .popdom-inner-sidebar form .customf, .listid').val('')
			}
		});
		$('#popup_domination_formhtml').change(function(){change_selects()});
		$('#popup_domination_email_box, #popup_domination_name_box').change(function(){ check_select(this) });
		
		$('.fancybox').fancybox({
			'type': 'iframe',
			'width': '75%',
			'height': '75%'
		});
		
		$('.landingpage #landingpage').click(function(){
			if ($('.landingpage #landingpage').attr('checked')) {
		        $('.landingurldiv').fadeIn();
		    }else{
		    	$('.landingurldiv').fadeOut();
		    }
	    });
	    
	    $('#landingurl').blur(function(){
	    	var url = $(this).val();
	    	$('#form .redirecturl').val(url);
	    })
		
		$('.show_mm_link').click(function(){
			$('.mailing-comps').fadeOut(function(){
				$('.main-menu').fadeIn();
			});
			$('.show_main_menu').fadeOut(function(){
				$('.show_mailing').fadeIn();
				$('.show_mail_link').css('display','block');
			});
		});
		
		$('.show_mail_link').click(function(){
			$('.main-menu').fadeOut(function(){
				$('.mailing-comps').fadeIn();
			});
			$('.show_mailing').fadeOut(function(){
				$('.show_main_menu').fadeIn();
				$('.show_mm_link').css('display','block');
			});
		});
	

		
		$('#nm_emailadd').change(function(){
			$('.provider').val('nm');
			var email = $('#nm_emailadd').val();
			$('.apikey').val(email);
			$('#form').prepend('<input type="hidden" name="listsid" value="' + popup_domination_url  + 'inc/email.php" />');
		});
	
		$('.mc_getlist').click(function(){
			mc_mail_list();	
		});
		
		$('.cm_getlist').click(function(){
			cm_mail_list();	
		});
		
		$('.aw_getlist').click(function(){
			aw_mail_list();	
		});
		
		$('.ic_getlist').click(function(){
			ic_mail_list();	
		});
		
		$('.cc_getlist').click(function(){
			cc_mail_list();	
		});
		
		$('.gr_getlist').click(function(){
			gr_mail_list();	
		});
		
		$('.other form').submit(function(){
			$('#form .provider').val('other');
		});
		
		$('#cc_custom_select').change(function(){
			$('#cc_custom2').hide();
			var num = $(this).val();
			var i = 1;
			while(i<=num){
				$('#cc_custom'+i).show();
				i++;
			}
		});
		
		$('#cc_custom1').change(function(){
			val = $(this).val();
			$('.custom1').val(val);
		})
		$('#cc_custom2').change(function(){
			val = $(this).val();
			$('.custom2').val(val);
		})
		$('#cm_custom_select').change(function(){
			$('.cm .cm_custom_fields').empty();
			$('.custom1, .custom2').hide();
			var num = $(this).val();
			var i = 1;
			while(i<=num){
				$('.custom'+i).show();
				i++;
			}
			$('.customf').val(i);
		});
		$('#gr_custom_select').change(function(){
			$('.custom1, .custom2').hide();
			var num = $(this).val();
			var i = 1;
			while(i<=num){
				$('.custom'+i).show();
				i++;
			}
			$('.customf').val(i);
		});
		$('#ic_custom_select').change(function(){
			$('.custom1, .custom2').hide();
			var num = $(this).val();
			var i = 1;
			while(i<=num){
				$('.custom'+i).show();
				i++;
			}
			$('.customf').val(i);
		});
		
		$('#popup_domination_disable_name').click(function(){
			if($(this).attr('checked') ==  'checked'){
				$('#popup_domination_name_box').attr('disabled','disabled');
			}else{
				$('#popup_domination_name_box').removeAttr('disabled');
			}
		});
		
		$('.aweber_cookieclear').click(function(){
			$('.popdom_contentbox_inside .waiting').show();
			var str = popup_domination_url;
			var str2 = str.split(website_url+'/');
			var f = str2[1];
			popup_domination_admin_ajax = 'index.php?section=ajax&action=ajax&do=awebercookiesclear';
			var data = {
				wpurl: f
			};
			jQuery.post(popup_domination_admin_ajax, data, function(response) {
				$('.popdom_contentbox_inside .waiting').hide();
			});
		});
		
		$('.mailing_lists').live("change",function(){
			$('.listname').val($(this).find("option:selected").text());
		});
		
		$('.apisubmit').live('click', function(){
			var listval = $('.mailing_lists option:selected').val();
			if( $('.listname').val().length === 0 ) {
				$('.listname').val($('.mailing_lists').find('option:selected').html());
			}
		});
		
		$('.getlist').click(function(){
			$('.popdom-inner-sidebar form .custom1, .popdom-inner-sidebar form .custom2, .popdom-inner-sidebar form .apikey, .popdom-inner-sidebar form .username, .popdom-inner-sidebar form .password, .popdom-inner-sidebar form .apiextra, .popdom-inner-sidebar form .listname, .popdom-inner-sidebar form .customf, .listid, #popup_domination_formhtml').val('');
			provider = $('.tab-menu .selected').attr('alt');
			$('.popdom-inner-sidebar form .provider').val(provider);
			if(provider == 'aw'){
				$('#form .disablename').hide();
				$('#form p').hide();
			}else{
				$('#form .disablename').show();
				$('#form p').show();
			}
		});

	});
	
	function hide(){
		$('.waiting').hide();
	}
	
	function set_cookie(name,value,date){
	var str = popup_domination_url;
		var str2 = str.split(website_url);
		var f = str2[1];
		window.document.cookie = [name+'='+escape(value),'expires='+date.toUTCString(),'path='+f+'inc/'].join('; ');
	};
	
	function change_selects(){
		var num_extra_inputs = numfields;
		$('#popup_domination_name_box option, #popup_domination_email_box option').remove();
		var tags = ['a','iframe','frame','frameset','script'], reg, val = $('#popup_domination_formhtml').val(),
			hdn = $('#popup_domination_hdn_div2'), action = $('#popup_domination_action'), hdn2 = $('#popup_domination_hdn_div');
	    action.val('');
		if($.trim(val) == '')
			return false;
		hdn2.html('');
		hdn.html('');
		for(var i=0;i<5;i++){
			reg = new RegExp('<'+tags[i]+'([^<>+]*[^\/])>.*?</'+tags[i]+'>', "gi");
			val = val.replace(reg,'');
			
			reg = new RegExp('<'+tags[i]+'([^<>+]*)>', "gi");
			val = val.replace(reg,'');
		}
		var tmpval;
		try {
			tmpval = decodeURIComponent(val);
		} catch(err){
			tmpval = val;
		}
		hdn.html(tmpval);
		var nameval = $('#popup_domination_name_box_selected').val();
		var emailval = $('#popup_domination_email_box_selected').val();
		var custom1 = $('#popup_domination_custom1_box_selected').val();
		var custom2 = $('#popup_domination_custom2_box_selected').val();
		
		if(typeof nameval != 'undefined' && nameval.length > 1){
			$('#popup_domination_name_box').append('<option value="'+nameval+'">'+nameval+'</option>');
		}if(typeof emailval != 'undefined' && emailval.length > 1){
			$('#popup_domination_email_box').append('<option value="'+emailval+'">'+emailval+'</option>');
		}if(typeof custom1 != 'undefined' && custom1.length > 1){
			$('#popup_domination_custom1_box').append('<option value="'+custom1+'">'+custom1+'</option>');
		}if(typeof custom2 != 'undefined' && custom2.length > 1){
			$('#popup_domination_custom2_box').append('<option value="'+custom2+'">'+custom2+'</option>');
		}else{
			$(':text',hdn).each(function(){
				var name = $(this).attr('name'),
					name_selected = name == $('#popup_domination_name_box_selected').val() ? ' selected="selected"' : '', 
					email_selected = name == $('#popup_domination_email_box_selected').val() ? ' selected="selected"' : '';
				$('#popup_domination_name_box').append('<option value="'+name+'"'+name_selected+'>'+name+'</option>');
				$('#popup_domination_email_box').append('<option value="'+name+'"'+email_selected+'>'+name+'</option>');
				for(i=1;i<=num_extra_inputs;i++){
					holdval = $('#popup_domination_custom'+i+'_box_selected').val();
					$('#popup_domination_custom'+i+'_box').append('<option value="'+name+'"'+name_selected+'>'+name+'</option>');
				}
			});
			$(':input',hdn).each(function(){
				if(typeof $(this).attr('name') != 'undefined'){
					hdn2.append($('<input type="hidden" name="field_name[]" />').val($(this).attr('name')));
					hdn2.append($('<input type="hidden" name="field_vals[]" />').val($(this).val()));
				}
			});
		}
		var hiddentmp = '';
		$(':input',hdn).each(function(){
			if(typeof $(this).attr('name') != 'undefined'){
				if($(this).attr('type') == 'hidden'){
					hiddentmp += '<input type="hidden" name="'+$(this).attr('name')+'" value="'+$(this).val()+'" />';
					
				}
			}
		});
		$('.hidden_fields').val(hiddentmp);
		$('img',hdn).each(function(){
			hdn2.append($('<input type="hidden" name="field_img[]" />').val($(this).attr('src')));
		});
		check_select('#popup_domination_name_box');
		action.val($('form',hdn).attr('action'));
		hdn.html('');
	};

	
	function check_select(elem){
		num_extra_inputs = 0;
		var id = 'popup_domination_email_box';
		if($(elem).attr('id') == id)
			id = 'popup_domination_name_box';
		var val1 = $(elem).val(), val2 = $('#'+id).val();
		if(val1 == val2){
			$('option:not([value="'+val1+'"]):eq(0)','#'+id).attr('selected',true);
		}
	};
	
	function mc_mail_list(){
		$('.mailing-ajax-waiting').show();
		var api_id = $('#mc_apikey').val();
		var data = {
			action: 'popup_domination_mailing_client',
			api_key: api_id,
			provider: 'mc'
		};
		jQuery.post(popup_domination_admin_ajax, data, function(response) {
			$('.mailing-ajax-waiting').hide();
			$('.mailingfeedback').empty();
			$('.mailingfeedback').append(response);
			$('#form .provider').val('mc');
			$('#form .apikey').val(api_id);
		});
	}
	
	function gr_mail_list(){
		$('.mailing-ajax-waiting').show();
		var api_id = $('#gr_apikey').val();
		var data = {
			action: 'popup_domination_mailing_client',
			api_key: api_id,
			provider: 'gr'
		};
		jQuery.post(popup_domination_admin_ajax, data, function(response) {
			$('.mailing-ajax-waiting').hide();
			$('.mailingfeedback').empty();
			$('.mailingfeedback').append(response);
			$('#form .provider').val('gr');
			$('#form .apikey').val(api_id);
		});
	}
	
	function cm_mail_list(){
		$('.mailing-ajax-waiting').show();
		var api_id = $('#cm_apikey').val();
		var client_id = $('#cm_clientid').val();
		var data = {
			action: 'popup_domination_mailing_client',
			api_key: api_id,
			client_id : client_id,
			provider: 'cm'
		};
		jQuery.post(popup_domination_admin_ajax, data, function(response) {
			$('.mailing-ajax-waiting').hide();
			$('.mailingfeedback').empty();
			$('.mailingfeedback').append(response);
			$('#form .provider').val('cm');
			$('#form .apikey').val(api_id);
		});
	}
	
	function aw_mail_list(){
		$('.mailing-ajax-waiting').show();
		var api_id = $('#aw_apikey').val();
		var client_id = $('#aw_clientid').val();
		var data = {
			action: 'popup_domination_mailing_client',
			provider: 'aw',
			token_key: api_id,
			token_secret : client_id
		};
		jQuery.post(popup_domination_admin_ajax, data, function(response) {
			$('.mailing-ajax-waiting').hide();
			$('.mailingfeedback').empty();
			$('.mailingfeedback').append(response);
			$('#form .provider').val('aw');
			$('#form .apikey').val(api_id);
			$('#form .apiextra').val($('#aw_clientid').val());
		});
	}
	
	function ic_mail_list(){
		$('.mailing-ajax-waiting').show();
		var api_id = $('#ic_apikey').val();
		console.log("current value = "+api_id);
		var password = $('#ic_password').val();
		var username = $('#ic_username').val();
		var data = {
			action: 'popup_domination_mailing_client',
			provider: 'ic',
			apikey: api_id,
			password : password,
			username : username
		};
		jQuery.post(popup_domination_admin_ajax, data, function(response) {
			$('.mailing-ajax-waiting').hide();
			$('.mailingfeedback').empty();
			$('.mailingfeedback').append(response);
			$('#form .provider').val('ic');
			$('#form .apikey').val(api_id);
			$('#form .username').val(username);
			$('#form .password').val(password);
		});
	}
	
	function cc_mail_list(){	
		$('.mailing-ajax-waiting').show();
		var api_id = $('.cc_apikey').val();
		var username = $('.cc_username').val();
		var secret = $('.cc_usersecret').val();
		var data = {
			action: 'popup_domination_mailing_client',
			provider: 'cc',
			token_key: api_id,
			username : username,
			user_secret : secret
		};
		jQuery.post(popup_domination_admin_ajax, data, function(response) {
			$('.mailing-ajax-waiting').hide();
			$('.mailingfeedback').empty();
			$('.mailingfeedback').append(response);
			$('#form .provider').val('cc');
			$('#form .apikey').val(api_id);
			$('#form .username').val(username);
			$('#form .password').val($('.cc_password').val());
			$('#form .apiextra').val($('.cc_usersecret').val());
			
			
		});
	}
	function get_hash(str){
		if(str.indexOf('#') !== -1)
			return str.split('#').pop();
		return str;
	};
	function init_tabs(){
	
		var linestart = true;
		var elem = $('#popup_domination_tabs a'), cur_hash = get_hash(document.location.hash);
		elem.each(function(){
			var hash = get_hash($(this).attr('href'));
			if($('#popup_domination_tab_'+hash).length > 0){
				$(this).click(function(){
					$('.custom1').hide();
					$('.custom2').hide();
					$('#cc_custom1').hide();
					$('#cc_custom2').hide();
					$('.mailingfeedback').empty();
					var id = get_hash($(this).attr('href'));
					//$('#popup_domination_form').attr('action',popup_domination_form_url+'#'+id);
					if(id == 'htmlform'){
						$('.apisubmit').hide();
						$('#landingurl').attr('disabled','disabled');
						$('#landingpage').attr('disabled','disabled');
						
					}else{
						$('.apisubmit').show();
						$('#landingurl').removeAttr('disabled');
						$('#landingpage').removeAttr('disabled');
					}
					id = '#popup_domination_tab_'+id;
					$(id).show();
					$('#popup_domination_container div[id^="popup_domination_tab_"]:not('+id+'):visible').toggle();
					$(id+':not(:visible)').toggle();
					$('.selected').removeClass('selected');
					$(this).addClass('selected');
					var provider = $(this).attr('alt');
					$('.popdom-inner-sidebar form .provider').val(provider);
					
				});
			}
		});

		if(cur_hash != ''){
			var elem2 = elem.filter('[href$="#'+cur_hash+'"]');
			if(elem2.length > 0){
				elem2.click();
				return;
			}
		}

		
		elem.filter(':eq(0)').click();
		
		
	};

	

})(jQuery);