;(function($){
	var deletethis = false;
	$(document).ready(function(){
		$('#popup_domination_active a').live('click',function(){
			var opts = {"todo":$(this).attr('class')};
			$.get('index.php?section=ajax&action=ajax&do=activation',opts,activate,'json');
			return false;
		});
		$('.spacing').hover(function(){
			//alert('hi');
			//alert($(' .spacing .slider')).height();
			$(this).children('.slider').stop().animate({left:'0%'},{queue:false,duration:150});
		},function(){
			$(this).children('.slider').stop().animate({left:'100%'},{queue:false,duration:150});
		});
		
		$('.help').click(function(){
			$(this).parent().find('.popdom_contentbox_inside').toggle('height');
		});
		
		$('.deletecamp').click(function(){
			if(confirm('You are about to DELETE a campaign, are you sure?')){
				var campid = $(this).attr('id');
				var campname = $(this).attr('title');
				var data = {
					campid: campid
				};
				var datas = {
					campname: campname
				}
				jQuery.post('index.php?section=ajax&action=ajax&do=deletecamp',data, function(response){
					$('#camprow_'+campid).fadeOut();
				});
				
				jQuery.post('index.php?section=ajax&action=ajax&do=deletestats',datas, function(response){
				});
			}
		});

	
		$('.togglecamp').live('click', function(){
		  $("*").css("cursor","wait");
			var id = $(this).attr('id');
			toggle(id);
			return false;
		});
		
		
		
		
		$('.deleteab').click(function(){
			if(confirm('You are about to DELETE a campaign, are you sure?')){
				var campid = $(this).attr('id');
				var data = {
					campid: campid
				};
				jQuery.post('index.php?section=ajax&action=ajax&do=deleteab',data, function(response){
					$('#camprow_'+campid).fadeOut();
				});
			}
		});
		$('#message').css('margin-top','30px').css('width','920px');
		$('#message:visible').delay(6000).fadeOut();
		
	
	});
	
	
	function toggle(id){
		var data = {
			action: 'togglecamp',
			id: id
		};
		jQuery.post("index.php?section=ajax&action=ajax&do=togglecamp", data, function(response) {
			alert(response);
			if (response == 0){
				$('.togglecamp').html("<span style='color:silver'>ON</span> | OFF").addClass('on').removeClass('off');
			} else {
				$('.togglecamp').html("ON | <span style='color:silver'>OFF</span>").addClass('off').removeClass('on');
			}
			$("*").css("cursor","auto");
		}).error(function(){
			alert("There was a problem with turning this campaign off within the database.");
		});
	}

	
	function activate(resp){
		var path = popup_domination_url;
		if(resp.error){
			alert(resp.error);
		} else if(resp.active){
				var txt = '<img src="'+path+'admin/css/images/off.png" alt="off" width="6" height="6" />', class1 = 'inactive', txt2 = '<img src="'+path+'admin/css/images/on.png" alt="on" width="6" height="6" />', class2 = 'turn-on', txt3 = 'Inactive', txt4 = 'Active',txt5 = 'TURN ON', txt6 = 'TURN OFF';
			if(resp.active == 'Y'){
				txt = '<img src="'+path+'admin/css/images/on.png" alt="on" width="6" height="6" />';
				txt2 = '<img src="'+path+'admin/css/images/off.png" alt="off" width="6" height="6" />';
				txt3 = 'Active';
				txt4 = 'Inactive';
				txt5 = 'TURN OFF';
				txt6 = 'TURN ON';
				class1 = 'active';
				class2 = 'turn-off';
			}
			$('#popup_domination_active').html('<span class="wording"><span class="'+class1+'">'+txt+'</span> PopUp Domination is '+txt3+' </span><div class="popup_domination_activate_button"><div class="border">'+txt2+'<a href="#activation" class="'+class2+'">'+txt5+'</a></div></div> <img class="waiting" style="display:none;" src="'+path+'css/images/wpspin_light.gif" alt="" />');
		} else {
			alert(resp);
		}
		$('#popup_domination_active .waiting').hide();
	};
	
})(jQuery);